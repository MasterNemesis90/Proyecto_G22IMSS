<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pediatria extends Model
{
    protected $table = 'pediatria';
    protected $primaryKey = 'id_expediente';
    public $timestamps=false;
    use HasFactory;
}
