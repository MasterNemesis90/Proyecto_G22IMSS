<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    protected $table = 'medicamentos';
    protected $primaryKey = 'id_medicamento';
    public $timestamps=false;
    use HasFactory;
}
