<?php

namespace App\Http\Controllers;

use App\Models\Dermatologia;
use App\Models\Medicamento;
use App\Models\Paciente;
use Illuminate\Http\Request;

class ControllerDermatologia extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientesDermatologia = Dermatologia::all();
        $paciente = Paciente::all();
        
        return view('Dashboard.paginas.Dermatologia.index', compact('pacientesDermatologia', 'paciente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medicamentos = Medicamento::all();

        $paciente = Paciente::where('id_tenant',auth()->user()->id_tenant)->get();

        return view('Dashboard.paginas.Dermatologia.registrarPaciente', compact('medicamentos','paciente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paciente = new Dermatologia();

        $idPaciente = Paciente::where('numero_cedula', $request->cedula)->first();

        if ($idPaciente != "") {

            $paciente->id_paciente =  $idPaciente->id_paciente;
            $paciente->fecha_ingreso = $request->fechaIngreso;
            $paciente->alergias = $request->alergias;
            $paciente->tratamientos_anteriores = $request->medicamento;
            $paciente->condiciones = $request->condicion;
    
            $paciente->save();
    
            return back();
           
        }else{

            return back();

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
        $derma = Dermatologia::find($id);
        $paciente = Paciente::find($derma->id_paciente);

        return view('Dashboard.paginas.Dermatologia.actualizarCondicion', compact('derma', 'paciente'));

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
        $derma = Dermatologia::find($id);

        $derma->fecha_ingreso = $request->fechaIngreso;
        $derma->alergias = $request->alergias;
        $derma->tratamientos_anteriores = $request->medicamento;
        $derma->condiciones = $request->condicion;

        $derma->save();

        return redirect()->route('dermatologia.index');

    }

    public function controlar_avance($id)
    {
        $derma = Dermatologia::find($id);
        $paciente = Paciente::find($derma->id_paciente);

        return view('Dashboard.paginas.Dermatologia.controlarAvance', compact('derma', 'paciente'));
    }

    public function actualizar_avance(Request $request, $id)
    {
        $derma = Dermatologia::find($id);

        $derma->descripcion = $request->descripcion;

        $derma->save();

        return redirect()->route('dermatologia.index'); 
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
}
