<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    use HasFactory;
    protected $table = "diagnosticos";
    protected $primaryKey = "id_diagnostico";
    public $timestamps = false;
}
