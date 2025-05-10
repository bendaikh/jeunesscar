<?php

namespace App;

use App\AdditionalDriver;
use App\Model\User;
use App\Model\VehicleModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

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
        'created_by'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'signed_at' => 'datetime'
    ];

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
        return number_format($this->total_amount, 2) . ' ' ."DHS";
    }
}