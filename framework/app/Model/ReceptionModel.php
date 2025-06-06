<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReceptionModel extends Model
{
    protected $table = 'vehicle_receptions';
    protected $fillable = [
        'vehicle_id', 'reception_date', 'km_in', 'previous_km', 
        'notes', 'user_id','created_by'
    ];

    // Relationship with vehicle
    public function vehicle()
    {
        return $this->belongsTo('App\Model\VehicleModel', 'vehicle_id');
    }

    // Relationship with user
    public function user()
    {
        return $this->belongsTo('App\Model\User', 'user_id');
    }

    // Relationship with media files
    public function media()
    {
        return $this->hasMany('App\Model\ReceptionMediaModel', 'reception_id');
    }
}
