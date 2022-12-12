<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\Paciente;
use App\Models\Sesion;
use Illuminate\Http\Request;

class ControllerPsicologia extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::all();


        return view('Dashboard.paginas.Psicologia.inicio_modulo', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.paginas.Psicologia.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paciente = Paciente::find($request->id_paciente);

        $mensaje = new Mensaje();
        $mensaje->id_paciente = $paciente->id_paciente;
        $mensaje->id_tenant = $paciente->id_tenant;
        $mensaje->id_tenant = $paciente->id_tenant;
        $mensaje->id_estado = 7;
        $mensaje->hora = date("h:i:s A");
        $mensaje->fecha = date("d-m-y");
        $mensaje->mensaje = $request->editor1;

        $mensaje->save();

        return back();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paciente = Paciente::find($id);

        $mensajes = Mensaje::where('id_paciente', $id);

        $sesiones = Sesion::where('id_paciente', $id);

        return view('Dashboard.paginas.Psicologia.paciente_piscologia', compact('paciente', 'mensajes', 'sesiones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


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
        $mensaje = Mensaje::find($request->id_mensaje);

        $mensaje->estado = 3;

        return back();

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


    public function paciente_psicologia(Request  $request){

        $paciente = Paciente::find($request->id_paciente);

        $mensajes = Mensaje::where('id_paciente', $request->id_paciente)->get();

        $sesiones = Sesion::where('id_paciente', $request->id_paciente)->get();

        return view('Dashboard.paginas.Psicologia.paciente_piscologia', compact('paciente','mensajes','sesiones'));
    }
    public function Inicio_paciente_psicologia(Request  $request){

        $paciente = Paciente::find($request->codigo_paciente);

        return view('Dashboard.paginas.Psicologia.mensaje', compact('paciente'));
    }

    public function mostar_mensaje(Request $request){

        $mensaje = Mensaje::find($request->id_mensaje);

        $mensaje->id_estado = 5;
        $mensaje->save();

        $paciente = Paciente::find($request->id_paciente);

        return view('Dashboard.paginas.Psicologia.mensaje_paciente', compact('mensaje','paciente'));

    }
    public function crearSesion(Request $request){

        $sesion = new Sesion();

        $paciente = Paciente::find($request->id_paciente);

        $sesion->id_paciente = $request->id_paciente;
        $sesion->id_tenant = auth()->user()->id_tenant;
        $sesion->id_estado = 1;
        $sesion->fecha = date("d-m-y");

        $sesion->save();

        return view('Dashboard.paginas.Psicologia.sesion', compact('sesion','paciente'));
 
    }
    public function guardarBitacora(Request $request){

        // $sesion = Sesion::find($request->id_sesion);

        // $sesion->bitacora = $request->editor1;

        // $sesion->save();

        return back();
 
    }
}
