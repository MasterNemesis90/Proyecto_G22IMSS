<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta_cobrar extends Model
{
    use HasFactory;
    
    protected $table = 'cuentas_cobrar';
    protected $primaryKey = 'id_cobro';
    public $timestamps=false;




    public function pacientes(){
        return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente');
    }
}
