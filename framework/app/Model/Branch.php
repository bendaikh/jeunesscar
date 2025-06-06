<?php
// filepath: /home/ouknik/Desktop/brahim_projects/j/j v2/jeunesscar/framework/app/Model/Branch.php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'address', 'city', 'phone', 'email', 
        'contact_person', 'details', 'is_active'
    ];

    // العلاقة مع المستخدمين
    public function users()
    {
        return $this->hasMany('App\Model\User');
    }

    // العلاقة مع المركبات
    public function vehicles()
    {
        return $this->hasMany('App\Model\VehicleModel', 'branch_id');
    }

    // العلاقة مع العقود
    public function contracts()
    {
        return $this->hasMany('App\Contract', 'branch_id');
    }

    // العلاقة مع الحجوزات
    public function bookings()
    {
        return $this->hasMany('App\Booking', 'branch_id');
    }

    // عقود الاستلام
    public function pickupContracts()
    {
        return $this->hasMany('App\Contract', 'pickup_branch_id');
    }

    // عقود التسليم
    public function dropoffContracts()
    {
        return $this->hasMany('App\Contract', 'dropoff_branch_id');
    }
}