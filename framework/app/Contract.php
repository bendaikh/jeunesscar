<?php

namespace App;

use App\AdditionalDriver;
use App\Model\User;
use App\Model\VehicleModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'contracts';
    
    protected $fillable = [
        'client_id',
        'vehicle_id',
        'contract_number',
        'start_date',
        'end_date',
        'duration',
        'daily_rate',
        'total_amount',
        'advance_payment',
        'remaining_amount',
        'status',
        'notes',
        'start_location',
        'end_location',
        'start_time',
        'end_time',
        'payment_method',
        'franchise',
        'client_signature',
        'witness_signature',
        'signed_at',
        'created_by',
        'branch_id',
        'pickup_branch_id',
        'dropoff_branch_id'
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'signed_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'signed_at' => 'datetime'
    ];

    // حساب المدة تلقائياً
    public function calculateDuration()
    {
        if ($this->start_date && $this->end_date) {
            $start = Carbon::parse($this->start_date)->startOfDay();
            $end = Carbon::parse($this->end_date)->startOfDay();
            return $start->diffInDays($end) ; // +1 لتضمين يوم البداية
        }
        return 0;
    }

    // تحديث المدة قبل الحفظ
    public static function boot()
    {
        parent::boot();

        static::saving(function ($contract) {
            if ($contract->start_date && $contract->end_date && !$contract->duration) {
                $contract->duration = $contract->calculateDuration();
            }
        });
    }

    public function setClientSignatureAttribute($value)
    {
        if ($value) {
            if (strpos($value, 'data:image/png;base64,') === false) {
                $value = 'data:image/png;base64,' . $value;
            }
            $this->attributes['client_signature'] = $value;
        }
    }

    public function setWitnessSignatureAttribute($value)
    {
        if ($value) {
            if (strpos($value, 'data:image/png;base64,') === false) {
                $value = 'data:image/png;base64,' . $value;
            }
            $this->attributes['witness_signature'] = $value;
        }
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(VehicleModel::class, 'vehicle_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function additionalDrivers()
    {
        return $this->hasMany(AdditionalDriver::class);
    }

    // دالة للحصول على حالة العقد مترجمة
    public function getStatusTextAttribute()
    {
        return __('contracts.status.'.$this->status);
    }

    // دالة لتنسيق المبلغ
    public function getFormattedTotalAmountAttribute()
    {
        // تنسيق المبلغ إلى صيغة العملة
        return number_format($this->total_amount, 2) . ' ' ."DHS " ;
    }

    // إضافة العلاقة مع الفرع
    public function branch()
    {
        return $this->belongsTo('App\Model\Branch');
    }

    // فرع الاستلام
    public function pickupBranch()
    {
        return $this->belongsTo('App\Model\Branch', 'pickup_branch_id');
    }

    // فرع التسليم
    public function dropoffBranch()
    {
        return $this->belongsTo('App\Model\Branch', 'dropoff_branch_id');
    }
}