<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerReportesCXP extends Controller
{
    //Reporte de Proveedores
    public function reporteProveedores()
    {
       return view('Dashboard.paginas.CXP.Reportes.reporteProveedores');
    }

    //Reporte de Ordenes de compra
    public function reporteOrdenesCompra()
    {
       return view('Dashboard.paginas.CXP.Reportes.reporteOrdenesCompra');
    }

    //Reporte de Inventario
    public function reporteInventario()
    {
       return view('Dashboard.paginas.CXP.Reportes.reporteInventario');
    }

    //Reporte de Cuentas por Pagar
    public function reporteCuentaPorPagar()
    {
       return view('Dashboard.paginas.CXP.Reportes.reporteCuentaPorPagar');
    }
    
    //Reporte de Cuentas por pagar por fecha
    public function reporteCuentaPorPagarPorFecha()
    {
       return view('Dashboard.paginas.CXP.Reportes.reporteCuentaPorPagarPorFecha');
    }

    //Reporte de Cuentas por pagar por fecha de vencimiento
    public function reporteCuentaPorFechaDeVencimiento()
    {
       return view('Dashboard.paginas.CXP.Reportes.reporteCuentaPorFechaDeVencimiento');
    }

    //Reporte de Cuentas por pagar vencidas
    public function reporteCuentaPorPagarVencidas() //
    {
       return view('Dashboard.paginas.CXP.Reportes.reporteCuentaPorPagarVencidas');
    }
    
    //Reporte de Cuentas por pagar pagadas
    public function reporteCuentaPorPagarPagadas()
    {
       return view('Dashboard.paginas.CXP.Reportes.reporteCuentaPorPagarPagadas');
    }

    //Reporte de Cuentas proximas a vencer
    public function reporteCuentaPorPagarProximasAVencer()
    {
       return view('Dashboard.paginas.CXP.Reportes.reporteCuentaPorPagarProximasAVencer');
    }
    

}
