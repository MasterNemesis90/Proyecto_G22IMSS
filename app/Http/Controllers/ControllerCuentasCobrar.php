<?php

namespace App\Http\Controllers;

use App\Models\Cuenta_cobrar;
use App\Models\Paciente;
use Illuminate\Http\Request;

class ControllerCuentasCobrar extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cobros = Cuenta_cobrar::all();
        return view('Dashboard.paginas.CxC.listaCobros', compact('cobros'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cobros()
    {
        $cobros = Cuenta_cobrar::all();
        return view('Dashboard.paginas.CxC.listaCobrosCompletados', compact('cobros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pacientes = Paciente::all();
        return view('Dashboard.paginas.CxC.crearCxC', compact('pacientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $cobro = new Cuenta_cobrar();

        $cobro->fecha_cobro = $request-> fecha_cobro;
        $cobro->fecha_vencimiento   = $request-> fecha_vencimiento;
        $cobro->id_estado        = $request-> id_estado;
        $cobro->id_paciente    = $request-> id_paciente;
        $cobro->id_tenant           =  auth()->user()->id_tenant;
        $cobro->saldo_anterior       = $request-> saldo_anterior;
        $cobro->saldo_actual       = $request-> saldo_actual;

        $cobro->save();

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
        $pacientes = Paciente::all();
        $cobro= Cuenta_cobrar::find($id);

        return view('Dashboard.paginas.CxC.editarCxC', compact('pacientes', 'cobro'));

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
        $cobro= Cuenta_cobrar::find($id);

        $cobro->fecha_cobro = $request-> fecha_cobro;
        $cobro->fecha_vencimiento   = $request-> fecha_vencimiento;
        $cobro->id_estado        = $request-> id_estado;
        $cobro->id_paciente    = $request-> id_paciente;
        $cobro->id_tenant           =  auth()->user()->id_tenant;
        $cobro->saldo_anterior       = $request-> saldo_anterior;
        $cobro->saldo_actual       = $request-> saldo_actual;

        $cobro->save();

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
    
    }

    public function cancelar($id){
        $cobro= Cuenta_cobrar::find($id);

        $cobro->id_estado = "2";

        $cobro->save();

        return back(); 
    }


    
}
