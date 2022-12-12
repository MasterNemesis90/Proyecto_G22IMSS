<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenats extends Model
{
    use HasFactory;
    protected $table = 'tenants';
    protected $primaryKey = 'id_tenant';
    public $timestamps = false;
}

// public function ingreso(){
//     return $this->belongsTo(asistencia_usuarios::class, 'id_usuario', 'id_usuario')->latest('id_asistencia');
// }

