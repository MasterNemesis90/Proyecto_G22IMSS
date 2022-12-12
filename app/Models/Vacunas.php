<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacunas extends Model
{
    protected $table = 'vacunas';
    protected $primaryKey = 'id_vacuna';
    public $timestamps=false;
    use HasFactory;
}
