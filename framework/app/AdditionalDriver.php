<?php

namespace App;

use App\Contract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalDriver extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'first_name',
        'last_name',
        'address',
        'id_number',
        'id_expiry_date',
        'license_number',
        'license_issue_date',
        'mobile'
    ];

    protected $casts = [
        'id_expiry_date' => 'date',
        'license_issue_date' => 'date',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
