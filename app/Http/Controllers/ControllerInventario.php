<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ControllerInventario extends Controller
{
    // VISTA DE CREAR PRODUCTO
    public function index() 
    {

        $provedores = Proveedor::where('id_tenant',auth()->user()->id_tenant)->get();
       return view('Dashboard.paginas.CXP.Inventario.crearProducto',compact('provedores'));
    }

    // CREAR UN     PRODUCTO DEL INVENTARIO


    public function crearNUevoProducto(Request $request)
    {

        // return $request;

        $inventario = new Inventario();

        // $inventario->id_producto        = $request-> id_producto;
        $inventario->codigo             = $request-> codigo;
        $inventario->nombre             = $request-> nombre;
        $inventario->descripcion        = $request-> descripcion;
        $inventario->stock              = $request-> stock;
        $inventario->fecha_ingreso      = $request-> fecha_ingreso;
        $inventario->id_tenant         = auth()->user()->id_tenant;
        $inventario->id_provedor       = $request->proveedor;
        

        $inventario->save();

        return back();
    }

    // MOSTRAR Inventario

    public function mostrarInventario(){
        $inventario = Inventario::where('id_tenant', '2')->get(); //AQUI VA EL ID DEL TENNANT PARA PODER EXTRAER LOS PROVEEDORES QUE PERTENESCAN A ESE TENANT
        
        return view('Dashboard.paginas.CXP.Inventario.listaInventario', compact('inventario'));
    }

    // ACTUALIZAR UN INVENTARIO
    
    public function updateProducto(Request $request, $id_producto)
    {

       $inventario = Inventario::find($id_producto) ;

       $inventario->codigo             = $request-> codigo;
       $inventario->nombre             = $request-> nombre;
       $inventario->descripcion        = $request-> descripcion;
       $inventario->stock              = $request-> stock;

         $inventario->save();
       

       return back();
    }

    // ELIMINAR UN PRODUCTO DEL INVENTARIO 

    public function eliminarProducto($id_producto)
    {
        $inventario = Inventario::find($id_producto);

        $inventario->delete();

        return back();
    }

    // VISTA DEL INVENTARIO A EDITAR

    public function buscarProducto($id_producto)
    {
        $inventario = Inventario::find($id_producto);

        return view('Dashboard.paginas.CXP.Inventario.editarProducto', compact('inventario'));
    }


}


