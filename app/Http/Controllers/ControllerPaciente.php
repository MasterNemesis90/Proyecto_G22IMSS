<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Servicios;
use Illuminate\Http\Request;

class ControllerPaciente extends Controller
{
    // VISTA DE CREAR PACIENTES
    public function index()
    {
       return view('Dashboard.paginas.Pacientes.crearPaciente');
    }

    // CREAR UN PACIENTE

    public function create(Request $request)
    {
        $paciente = new Paciente();

        $paciente-> id_tenant= auth()->user()->id_tenant;
        $paciente->nombre_completo = $request-> nombre_completo;
        $paciente->numero_cedula   = $request-> numero_cedula;
        $paciente->telefono        = $request-> telefono;
        $paciente->nacionalidad    = $request-> nacionalidad;
        $paciente->dimex           = $request-> dimex;
        $paciente->direccion       = $request-> direccion;
        $paciente->fecha_nacimiento= $request-> fecha_nacimiento;
        $paciente->correo          = $request-> correo;
        $paciente->sexo            = $request-> sexo;
        $paciente->nombre_completo_padre = $request-> nombre_completo_padre;
        $paciente->nombre_completo_madre = $request-> nombre_completo_madre;
        $paciente->estado_civil          = $request-> estado_civil;
        $paciente->edad_registro         = $request-> edad_registro;
        $paciente->tipo_sangre           = $request-> tipo_sangre;
        $paciente->id_estado       = $request-> estado_paciente;

        $paciente->save();

        return back();
    }

    // MOSTRAR PACIENTES

    public function mostrarP(){
        $pacientes = Paciente::where('id_tenant', auth()->user()->id_tenant)->get(); //AQUI VA EL ID DEL TENNANT PARA PODER EXTRAERLOS PACIENTES QUE PERTENESCAN A ESE TENANT
        
        return view('Dashboard.paginas.Pacientes.listaPacientes', compact('pacientes'));
    }

    // ACTUALIZAR UN PACIENTE
    
    public function update(Request $request, $id)
    {
       $paciente= Paciente::find($id) ;

       $paciente->nombre_completo = $request-> nombre_completo;
       $paciente->numero_cedula   = $request-> numero_cedula;
       $paciente->telefono        = $request-> telefono;
       $paciente->nacionalidad    = $request-> nacionalidad;
       $paciente->dimex           = $request-> dimex;
       $paciente->direccion       = $request-> direccion;
       $paciente->fecha_nacimiento= $request-> fecha_nacimiento;
       $paciente->correo          = $request-> correo;
       $paciente->sexo            = $request-> sexo;
       $paciente->nombre_completo_padre = $request-> nombre_completo_padre;
       $paciente->nombre_completo_madre = $request-> nombre_completo_madre;
       $paciente->estado_civil          = $request-> estado_civil;
       $paciente->edad_registro         = $request-> edad_registro;
       $paciente->tipo_sangre           = $request-> tipo_sangre;
       $paciente->id_estado       = $request-> estado_paciente;

       $paciente->save();

       return back();
    }

    // ELIMINAR UN PACIENTE    

    public function destroy($id)
    {
        $paciente = Paciente::find($id);

        $paciente->id_estado = 2;

        $paciente->save();

        return back();
    }

    // VISTA DEL PACIENTE A EDITAR

    public function buscar($id)
    {
        $paciente = Paciente::find($id);

        return view('Dashboard.paginas.Pacientes.editarPaciente', compact('paciente'));
    }

    // MOSTRAR PACIENTES DESACTIVADOS

    public function mostrarPacientesD()
    {
        $pacientes = Paciente::where('id_tenant', auth()->user()->id_tenant)->get(); //AQUI VA EL ID DEL TENNANT PARA PODER EXTRAERLOS PACIENTES QUE PERTENESCAN A ESE TENANT
    
        return view('Dashboard.paginas.Pacientes.listaPacientesDesactivados', compact('pacientes'));
    }

    //ACTIVAR PACIENTE

    public function activarP($id){

        $pacientes = Paciente::find($id); //AQUI VA EL ID DEL TENNANT PARA PODER EXTRAERLOS PACIENTES QUE PERTENESCAN A ESE TENANT
        
        // return $pacientes;

        $pacientes->id_estado = "1";

        $pacientes->save();

        return back();

    }

}
