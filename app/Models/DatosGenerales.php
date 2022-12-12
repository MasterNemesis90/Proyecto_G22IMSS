<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosGenerales extends Model
{
    protected $table = 'datos';
    protected $primaryKey = 'id_datos';
    public $timestamps=false;
    use HasFactory;
}
