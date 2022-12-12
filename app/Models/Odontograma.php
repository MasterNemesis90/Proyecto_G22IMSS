<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Odontograma extends Model
{
    use HasFactory;
    public $timestamps=false;
    public $fillable = ["id","ruta_odontograma", "descripcion", "id_paciente", "diente", "diagnostico"];
}
