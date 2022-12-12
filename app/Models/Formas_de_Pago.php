<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formas_de_Pago extends Model
{
    use HasFactory;
    protected $table = "formas_pago";
    protected $primaryKey = "id_forma_pago";
    public $timestamps = false;
}
