<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use Illuminate\Http\Request;

class ControllerCitas extends Controller
{
    public function ListaCitas()
    {
        $cita= Cita::select('citas.fecha', 'citas.hora', 'pacientes.nombre_completo as paciente_nombre','pacientes.numero_cedula')
        ->join('pacientes', 'citas.id_paciente', '=', 'pacientes.id_paciente')
        ->get();
        return view('Dashboard.paginas.Citas.mostrar_citas', compact('cita'));
    }
    public function Generarcita(Request $request)
    {
        $nuevacita= new Cita();
        $nuevacita->id_tenant = auth()->user()->id_tenant;
        $nuevacita->id_paciente=$request->nombre;
        $nuevacita->fecha=$request->fecha;
        $nuevacita->hora=$request->hora;
        $nuevacita->motivo_cita=$request->motivo;
        $nuevacita->comentarios=$request->nota;
        $nuevacita->tipo_cita=$request->tipo;
        $nuevacita->id_estado=6;

        $nuevacita->save();
        return back();
        //return view('agendar_cita');
    }
    public function crearcita()
    
{
    $cita = Paciente::all();
    return view('Dashboard.paginas.Citas.agendar_cita', compact('cita'));
}


public function verCitasPendientes()
{
    $cita= Cita::select('citas.*','pacientes.nombre_completo as paciente_nombre','pacientes.numero_cedula','pacientes.id_paciente')
    ->join('pacientes', 'citas.id_paciente', '=', 'pacientes.id_paciente')
    ->get();
    return view('Dashboard.paginas.Citas.citas_pendientes',compact('cita'));
}

public function eliminarcita($id)
{
    $citaEliminar= Cita::findOrFail($id);
    $citaEliminar->delete();

    return back();
}

}
