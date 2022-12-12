<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Tenats;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Builder\Use_;

class ControllerPerfil extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // return auth()->user()->id_tenant;
    $tenant = Tenats::where('id_tenant',auth()->user()->id_tenant)->first();


    // return $tenant ;

    return view('Dashboard.paginas.perfil',compact('tenant'));
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

       $tenant = Tenats::where('id_tenant',auth()->user()->id_tenant)->first();

       $tenant->fecha_nacimiento = $request->fecha; 
       $tenant->cedula =    $request->cedula;
       $tenant->pais_estadia =    $request->pais;
       $tenant->telefono =    $request->telefono;
       $tenant->nombre_medico = $request->nombre ;
       $tenant->contraseña =   $request->contra;
       $tenant->correo =  $request->correo ;

       $tenant->save();

       $usuario = User::where('id_tenant',auth()->user()->id_tenant)->where('tipo_usuario','Administrador')->first();

//    $tenant = new User();
       $usuario->nombre_completo = $tenant->nombre_medico ;
       $usuario->correo =  $tenant->correo ;
       $usuario->contraseña =    $tenant->contraseña;

       $usuario->save();


       return back()->with('perfil','Su perfil de usuario ha sido actualizado');;

        

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
        //
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

      
        // $tenant = Tenats::where('id_tenant',auth()->user()->id_tenant)->first();

        if ($_FILES['foto_principal']['name'] != null) {

            $directorio = 'storage/';
            $archivito = $directorio.basename($_FILES['foto_principal']['name']);  
            $image = $request->file('foto_principal');
            $destinationPath = public_path('storage');
            $image->move($destinationPath,  $archivito);

               Tenats::where('id_tenant', auth()->user()->id_tenant)
               ->update(['logo_clinica' =>  $archivito]);   

               return back();
    
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
        //
    }


    public function storageEmpre(Request $request){

        


        $tenant = Tenats::where('id_tenant',auth()->user()->id_tenant)->first();

        $tenant->nombre_clinica = $request->nombre_clinica; 
        $tenant->telefono_cliinica =    $request->telefono_clinica;
        $tenant->ubicacion_clinica =    $request->ubicacion_clinica;
        
        $tenant->save();

        return back()->with('empre','Su perfil empresarial ha sido actualizado');

    }


}
