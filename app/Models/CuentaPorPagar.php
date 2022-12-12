<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaPorPagar extends Model
{
    protected $table = 'cuentas_pagar';
    protected $primaryKey = 'id_cuentasporpagar';
    public $timestamps=false;
    use HasFactory;
}
