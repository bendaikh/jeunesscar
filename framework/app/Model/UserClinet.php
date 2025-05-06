<?php

namespace App\Model;

use App\Model\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserClinet extends Model
{
    use HasFactory;

     protected $table = "user_clients";
    protected $fillable = [
        'user_clients_id',
        'id_number',
        'id_expiry_date',
        'license_number',
        'license_issue_date',
        'passport_number',
        'passport_issue_date',
        'mobile',
    ];



    public function userinfo()
    {
        return $this->belongsTo(User::class, 'user_clients_id', 'id');
    }

   
}
