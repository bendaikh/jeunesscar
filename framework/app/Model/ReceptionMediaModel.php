<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReceptionMediaModel extends Model
{
    protected $table = 'reception_media';
    
    // Es importante incluir todos estos campos
    protected $fillable = [
        'reception_id', 
        'file_path', 
        'file_type'
    ];
    
    // Si solo necesitas la fecha de creación
    public $timestamps = ['created_at']; 
    
    // Para deshabilitar updated_at si solo usas created_at
    const UPDATED_AT = null;

    // Relationship with reception
    public function reception()
    {
        return $this->belongsTo('App\Model\ReceptionModel', 'reception_id');
    }
}
