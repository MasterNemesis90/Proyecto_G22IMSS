<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden_Compra extends Model
{
    protected $table = 'orden_compra';
    protected $primaryKey = 'id_orden_compra';
    public $timestamps=false;
    use HasFactory;
}
