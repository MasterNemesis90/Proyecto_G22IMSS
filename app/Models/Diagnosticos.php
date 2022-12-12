<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosticos extends Model
{
    protected $table = 'diagnosticos';
    protected $primaryKey = 'id_diagnostico';
    public $timestamps=false;
    use HasFactory;
}
