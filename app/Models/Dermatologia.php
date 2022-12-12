<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dermatologia extends Model
{
    protected $table = 'dermatologia';
    protected $primaryKey = 'id_expediente';
    public $timestamps=false;
    use HasFactory;
}
