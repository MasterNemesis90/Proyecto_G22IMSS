<?php

namespace App\Http\Controllers;

use App\Models\CuentaPorPagar;
use Illuminate\Http\Request;

class ControllerCuentaPorPagar extends Controller
{
    // VISTA DE CREAR CXP
    public function index()
    {
       return view('Dashboard.paginas.CXP.CuentaPorPagar.crearCuentaPorPagar');
    }

     // ABONAR A UNA CXP
     public function abonarCuentaPorPagar()
     {
        return view('Dashboard.paginas.CXP.CuentaPorPagar.abonarCuentaPorPagar');
     }

      // CANCELAR UNA CXP
    public function cancelarCuentaPorPagar()
    {
       return view('Dashboard.paginas.CXP.CuentaPorPagar.cancelarCuentaPorPagar');
    }

    // CREAR UNa CXP


    public function create(Request $request)
    {
        $cuentaporpagar = new CuentaPorPagar();

        $cuentaporpagar->id_cuentasporpagar    = $request-> id_cuentasporpagar;
        $cuentaporpagar->id_proveedor          = 1;
        $cuentaporpagar->cuenta_bancaria       = $request-> cuenta_bancaria;
        $cuentaporpagar->numero_factura        = $request-> numero_factura;
        $cuentaporpagar->tipo_pago             = $request-> tipo_pago;
        $cuentaporpagar->fecha_recibir_factura = $request-> fecha_recibir_factura;
        $cuentaporpagar->plazo_pago            = $request-> plazo_pago;
        $cuentaporpagar->monto_pagar           = $request-> monto_pagar;
        $cuentaporpagar->id_estado             = 1;
        $cuentaporpagar->saldo_actual          = $request-> saldo_actual;
        $cuentaporpagar->saldo_anterior        = $request-> saldo_anterior;
        $cuentaporpagar->id_tenant            = auth()->user()->id_tenant;
        

        $cuentaporpagar->save();

        return back();
    }

    // MOSTRAR CXP's

    public function mostrarCuentasPorPagar(){
        $cuentaporpagar = CuentaPorPagar::where('id_tenant', '2')->get(); //AQUI VA EL ID DEL TENNANT PARA PODER EXTRAER LOS PROVEEDORES QUE PERTENESCAN A ESE TENANT
        
        return view('Dashboard.paginas.CXP.CuentaPorPagar.listaCuentasPorPagar', compact('cuentaporpagar'));
    }

    // ACTUALIZAR UNA CXP
    
    public function updateCuentaPorPagar(Request $request, $id_cuentasporpagar)
    {
       $cuentaporpagar = CuentaPorPagar::find($id_cuentasporpagar) ;

       
       $cuentaporpagar->cuenta_bancaria       = $request-> cuenta_bancaria;
       $cuentaporpagar->numero_factura        = $request-> numero_factura;
       $cuentaporpagar->tipo_pago             = $request-> tipo_pago;
       $cuentaporpagar->fecha_recibir_factura = $request-> fecha_recibir_factura;
       $cuentaporpagar->plazo_pago            = $request-> plazo_pago;
       $cuentaporpagar->monto_pagar           = $request-> monto_pagar;
       $cuentaporpagar->id_estado             =  $cuentaporpagar->id_estado;
       $cuentaporpagar->plazo_pago            = $request-> plazo_pago;
       $cuentaporpagar->monto_pagar           = $request-> monto_pagar;
    //    $cuentaporpagar->id_estado           =  $cuentaporpagar->id_estado;

       $cuentaporpagar->save();

       return back();
    }

    // ELIMINAR UN PRODUCTO DEL INVENTARIO 

    public function eliminarCuentaPorPagar($id_cuentasporpagar)
    {
        $cuentaporpagar = CuentaPorPagar::find($id_cuentasporpagar);

        $cuentaporpagar->delete();

        return back();
    }

    // VISTA DEL INVENTARIO A EDITAR

    public function buscarCuentaPorPagar($id_cuentasporpagar)
    {
        $cuentaporpagar = CuentaPorPagar::find($id_cuentasporpagar);

        return view('Dashboard.paginas.CXP.CuentaPorPagar.editarCuentaPorPagar', compact('cuentaporpagar'));
    }


}
