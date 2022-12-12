<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ControllerUsuarios extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // return 1;

        $usuarios =  User::where([['id_tenant',auth()->user()->id_tenant],['tipo_usuario','Usuario']])->get();

         return view('Dashboard.paginas.usuarios',compact('usuarios'));

        

        // return view('Dashboard.paginas.Pacientes.crearPaciente');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (User::where('correo', '=', $request->correo)->exists()) {

            return back()->with('error', 'El correo ya se encuentra registrado');
            
         }else{
    //  return 1;
        $usuarios = new User();
        $usuarios->id_tenant =  auth()->user()->id_tenant ;
        $usuarios->correo =  $request->correo ;
        $usuarios->tipo_usuario =  "Usuario" ;
        $usuarios->contraseña =    $request->contraseña;
        $usuarios->nombre_completo = $request->nombre;
        $usuarios->fecha_ingreso = date("Y-m-d"); 
        $usuarios->especialidad = $request->especialidad;
        $usuarios->id_estado = 1;
        $usuarios->save();

        return back()->with('exito1', 'Usuario creado con exito');;
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);

        return  $usuario;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $usuario =  User::find($request->id_usuario);

        if ($usuario->correo !=  $request->correoC ) {
            
            if (User::where('correo', '=', $request->correoC)->exists()) {

               return back()->with('error2', 'El correo ya se encuentra registrado')->with('errorCorreo',$request->id_usuario);
        
            }else{

                $usuarios = User::find($request->id_usuario);
                // $usuarios->id_tenant =  19 ;
                $usuarios->correo =  $request->correoC;
                // $usuarios->tipo_usuario =  "Usuario" ;
                $usuarios->contraseña =    $request->contraseñaC;
                $usuarios->nombre_completo = $request->nombreC;
                // $usuarios->fecha_ingreso = date("Y-m-d"); 
                $usuarios->especialidad = $request->especialidadC;
                // $usuarios->id_estado = 1;
                $usuarios->save();
        
                return back()->with('devulta',$request->id_usuario)->with('exito1', 'Se actualizo con exito');

            }
      
         }else{
        // return 1;
        $usuarios = User::find($request->id_usuario);
        // $usuarios->id_tenant =  19 ;
        $usuarios->correo =  $request->correoC;
        // $usuarios->tipo_usuario =  "Usuario" ;
        $usuarios->contraseña =    $request->contraseñaC;
        $usuarios->nombre_completo = $request->nombreC;
        // $usuarios->fecha_ingreso = date("Y-m-d"); 
        $usuarios->especialidad = $request->especialidadC;
        // $usuarios->id_estado = 1;
        $usuarios->save();

        return back()->with('devulta',$request->id_usuario)->with('exito1', 'Se actualizo con exito');
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return back();
    }


    public function editarEstado($id)
    {
        User::where('id_usuario', $id)
        ->update(['id_estado' =>  1]);

        return back();
    }

    public function editarEstadoDesactivo($id)
    {
        User::where('id_usuario', $id)
        ->update(['id_estado' =>  2]);

        return back();
    }
}
