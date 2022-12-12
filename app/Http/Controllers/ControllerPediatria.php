<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\DatosGenerales;
use App\Models\Diagnosticos;
use App\Models\Medicamento;
use App\Models\Paciente;
use App\Models\Vacunas;
use Illuminate\Http\Request;

class ControllerPediatria extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //     $compra = Cita::join('estados', 'estados.id_estado', '=', 'citas.id_estados')->select("*","estados.estado")
    // ->join('pacientes', 'pacientes.id_paciente', '=', 'citas.id_paciente')->select("*","pacientes.nombre_completo")
    // ->where('compra.id_proveedor','=',$id)->get();

    $cita = Cita::join('estados', 'estados.id_estado', '=', 'citas.id_estado')->select("*","estados.estado")
    ->join('pacientes', 'pacientes.id_paciente', '=', 'citas.id_paciente')->select("*","pacientes.nombre_completo")->get();

    return view('Dashboard.paginas.Pediatria.index',compact('cita'));
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
        //
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


    public function atender($id){
         $cita = Cita::find($id);

         $cita->id_estado = 5;

         $cita->save();

        return redirect('pediatria');
    }

    public function crearDatos($id,Request $request)
    {
        $cita =Cita::find($id);
        $idP = $cita->id_paciente;

        $datosN = new Pediatria();
        
        $datosN->id_tenant = auth()->user()->id_tenant;
        $datosN->id_paciente = $idP;
        $datosN->peso = $request->peso;
        $datosN->estatura = $request->estatura;
        $datosN->temperatura = $request->temperatura;
        $datosN->ritmo_cardiaco = $request->ritmo;

        $datosN->save();

        return back();
    }





    public function consulta($id){
        // $cita = Cita::find($id);

        // $cita->id_estado = 5;

        // $cita->save();
        $cita =Cita::find($id);
        $idP = $cita->id_paciente;
        return view('Dashboard.paginas.Pediatria.create',compact('id'));
    }


    //VACUNAS

    public function vacunas($id){


        $cita =Cita::find($id);
        $idP = $cita->id_paciente;

        $pediatria = Pediatria::where('id_paciente' ,'=',$idP)->get();
        $vacuna = Vacunas::where('id_expediente','=',$pediatria[0]->id_expediente)->get();

        return view('Dashboard.paginas.Pediatria.vacunasIndex',compact('vacuna','id'));

    }

    public function verNV($id){

        return view('Dashboard.paginas.Pediatria.VacunaN',compact('id'));
    }

    public function crearV($id, Request $request){

        $cita =Cita::find($id);
        $idP = $cita->id_paciente;
        $pediatria = Pediatria::where('id_paciente' ,'=',$idP)->get();

        $vacuna = new Vacunas();

        $vacuna->id_tenant = auth()->user()->id_tenant;
        $vacuna->id_expediente = $pediatria[0]->id_expediente;
        $vacuna->detalle = $request->detaVacuna;
        $vacuna->fecha_vacuna = $request->fechaVacuna;
        $vacuna->nombre_vacuna = $request->nVacuna;
        $vacuna->edad_vacunacion = $request->eVacuna;

        $vacuna->save();

        return back();
    }

    //DIAGNOSTICOS

    public function verDiagnostico($id)
    {
        return view('Dashboard.paginas.Pediatria.diagnosticoC',compact('id'));
    }  
    

    public function crearD($id,Request $request)
    {

    $cita =Cita::find($id);
    $idP = $cita->id_paciente;

    $diag = new Diagnosticos();
    $diag->id_tenant = auth()->user()->id_tenant;
    $diag->id_paciente = $idP;
    $diag->nombre_enfermedad = $request->diagnostico;

    $diag->save();

    $pediatria = Pediatria::where('id_paciente' ,'=',$idP)->get();
    $pediatriaN = Pediatria::find($pediatria[0]->id_expediente);
    
    $pediatriaN->id_diagnostico = $diag->id_diagnostico;


    $pediatriaN->save();

    return back();

    }

    //MEDICAMENTOS

    public function verMedi($id){
        return view('Dashboard.paginas.Pediatria.medicamentos',compact('id'));
    }

    public function crearM($id,Request $request)
    {

    $cita =Cita::find($id);
    $idP = $cita->id_paciente;

    $med = new Medicamento();
    $med->id_tenant = auth()->user()->id_tenant;
    $med->id_paciente = $idP;
    $med->nombres_medicamento = $request->nMedicina;
    $med->precio = $request->pMedicina;
    $med->descripcion_medicamento = $request->dMedicina;

    $med->save();

     return back();
    }
}
