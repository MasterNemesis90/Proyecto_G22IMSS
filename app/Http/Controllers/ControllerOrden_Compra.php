<?php

namespace App\Http\Controllers;
use App\Models\Orden_Compra;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ControllerOrden_Compra extends Controller
{
    // VISTA DE CREAR UNA ORDEN DE COMPRA
    public function index()
    {

    $provedores = Proveedor::where('id_tenant',auth()->user()->id_tenant)->get();
       return view('Dashboard.paginas.CXP.Orden_Compra.crearOrden_Compra',compact('provedores'));
    }

    // CREAR UN  ORDEN DE COMPRA


    public function create(Request $request)
    {
        $orden = new Orden_Compra();

        $orden->id_orden_compra             = $request-> id_orden_compra   ;
        $orden->fecha                       = $request-> fecha;
        $orden->lugar                       = $request-> lugar;
        $orden->terminos_entrega            = $request-> terminos_entrega;
        $orden->cantidad_producto           = $request-> cantidad_producto;
        $orden->descripcion                 = $request-> descripcion;
        $orden->precio                      = $request-> precio;
        $orden->gasto_envio                 = $request-> gasto_envio;
        $orden->pago_total                  = $request-> pago_total;
        $orden->id_estado                   = 1;
        $orden->id_tenant                   =  auth()->user()->id_tenant;
        $orden->id_proveedor                = 1;
        
        

        $orden->save();

        return back();
    }

    // MOSTRAR UNA ORDEN DE COMPRA

    public function mostrarOrdenesCompra(){
        $orden= Orden_Compra::where('id_tenant', '2')->get(); //AQUI VA EL ID DEL TENNANT PARA PODER EXTRAER LOS PROVEEDORES QUE PERTENESCAN A ESE TENANT
        
        return view('Dashboard.paginas.CXP.Orden_Compra.listaOrdenes_Compra', compact('orden'));
    }

    public function editOrden($orden)
    {

        $orden= Orden_Compra::find($orden) ;

    
       return view('Dashboard.paginas.CXP.Orden_Compra.editarOrden_Compra',compact('orden'));
    }

    // ACTUALIZAR UNA ORDEN DE COMPRA
    
    public function updateOrdenCompra(Request $request, $id_orden_compra)
    {
       $orden= Orden_Compra::find($id_orden_compra) ;


       
       $orden->lugar              =  $orden->lugar ;  
       $orden->fecha             =  $orden->fecha ;

       $orden->terminos_entrega              = $request-> terminos_entrega;
       $orden->cantidad_producto             = $request-> cantidad_producto;
       $orden->descripcion                   = $request-> descripcion;
       $orden->precio                        = $request-> precio;
       $orden->gasto_envio                   = $request-> gasto_envio;
       $orden->pago_total                    = $request-> pago_total;
       
       $orden->save();

       return back();
    }

    // ELIMINAR UNA ORDEN DE COMPRA 

    public function eliminarOrdenCompra($id_orden_compra)
    {
        $orden= Orden_Compra::find($id_orden_compra);

        $orden->delete();

        return back();
    }

    // VISTA DE LA  ORDEN DE COMPRA A EDITAR

    public function buscarProveedor($id_orden_compra)
    {
        $proveedor = Proveedor::find($id_orden_compra);
        
        return view('Dashboard.paginas.CXP.Orden_COmpra.editarOrden_Compra', compact('orden'));
    }
}