<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ControllerProveedor extends Controller
{
    // VISTA DE CREAR PROVEEDOR
    public function index()
    {
       return view('Dashboard.paginas.CXP.Proveedor.crearProveedor');
    }

    // CREAR UN     // VISTA DE CREAR PROVEEDOR


    public function create(Request $request)
    {
        $proveedor = new Proveedor();

        // $proveedor->id_proveedor                 = $request-> id_proveedor;
        $proveedor->nombre                       = $request-> nombre;
        $proveedor->numero_cedula_juridica       = $request-> numero_cedula_juridica;
        $proveedor->direccion                    = $request-> direccion;
        $proveedor->telefono                     = $request-> telefono;
        $proveedor->correo                       = $request-> correo;
        $proveedor->id_tenant                   = auth()->user()->id_tenant;
        

        $proveedor->save();

        return back();
    }

    // MOSTRAR Proveedor

    public function mostrarProveedores(){
        $proveedor = Proveedor::where('id_tenant', auth()->user()->id_tenant)->get(); //AQUI VA EL ID DEL TENNANT PARA PODER EXTRAER LOS PROVEEDORES QUE PERTENESCAN A ESE TENANT
        
        return view('Dashboard.paginas.CXP.Proveedor.listaProveedores', compact('proveedor'));
    }

    // ACTUALIZAR UN PROVEEDOR
    
    public function updateProveedor(Request $request, $id_proveedor)
    {
       $proveedor= Proveedor::find($id_proveedor) ;

       $proveedor->nombre                       = $request-> nombre;
       $proveedor->numero_cedula_juridica       = $request-> numero_cedula_juridica;
       $proveedor->direccion                    = $request-> direccion;
       $proveedor->telefono                     = $request-> telefono;
       $proveedor->correo                       = $request-> correo;

       $proveedor->save();

       return back();
    }

    // ELIMINAR UN PROVEEDOR 

    public function eliminarProveedor($id_proveedor)
    {
        $proveedor = Proveedor::find($id_proveedor);

        $proveedor->save();

        return back();
    }

    // VISTA DEL PROVEEDOR A EDITAR

    public function buscarProveedor($id_proveedor)
    {

        // return 1;
         $proveedor = Proveedor::find($id_proveedor);
        

         return view('Dashboard.paginas.CXP.Proveedor.editarProveedor', compact('proveedor'));
    }


}

