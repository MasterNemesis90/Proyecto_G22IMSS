<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Tenant;
use Illuminate\Http\Request;

class ControllerTenant extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tenants = Tenant::all();

        $tenants = Tenant::all();

        return view('Dashboard.parte_administrativa.tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $estados = Estado::all();
        return view('Dashboard.parte_administrativa.tenants.create', compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tenants = new Tenant();
        $tenants->nombre_medico = $request->nombre_medico;
        $tenants->correo = $request->correo;
        $tenants->cedula = $request->ceduAdmin;
        $tenants->fecha_nacimiento = $request->fecha_nacimiento;
        $tenants->nacionalidad = $request->nacionalidad;
        $tenants->telefono = $request->telefono;
        $tenants->pais_estadia = $request->pais_estadia;
        $tenants->fecha_pago_efectuado = $request->fecha_pago_efectuado;
        $tenants->proximo_pago = $request->proximo_pago;
        $tenants->nombre_clinica = $request->nombre_clinica;
        $tenants->telefono_cliinica = $request->telefono_clinica;
        $tenants->ubicacion_clinica = $request->ubicacion_clinica;
        $tenants->logo_clinica = "logo.png";
        $tenants->tipo_plan = $request->tipo_plan;
        $tenants->codigo_paypal = "Aprovado";
        $tenants->estado = 1;
        $tenants->cuenta_validad = 1;
        $tenants->contraseña = $request->contraAdmin;

        $tenants->save();


        return back();

        // return view('Dashboard.parte_administrativa.tenants.index');

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
        $tenants = Tenant::findOrFail($id);
        $estados = Estado::all();
        return view('Dashboard.parte_administrativa.tenants.edit', compact('tenants', 'estados'));
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
        $tenants = Tenant::findOrFail($id);
        $tenants->nombre_medico = $request->nombre_medico;
        $tenants->correo = $request->correo;
        $tenants->fecha_nacimiento = $request->fecha_nacimiento;
        $tenants->nacionalidad = $request->nacionalidad;
        $tenants->telefono = $request->telefono;
        $tenants->pais_estadia = $request->pais_estadia;
        $tenants->fecha_pago_efectuado = $request->fecha_pago_efectuado;
        $tenants->proximo_pago = $request->proximo_pago;
        $tenants->nombre_clinica = $request->nombre_clinica;
        $tenants->telefono_clinica = $request->telefono_clinica;
        $tenants->ubicacion_clinica = $request->ubicacion_clinica;
        $tenants->logo_clinica = $request->logo_clinica;
        $tenants->tipo_plan = $request->tipo_plan;
        $tenants->codigo_paypal = $request->codigo_paypal;
        $tenants->id_estado = $request->id_estado;
        $tenants->cuenta_valida = $request->cuenta_valida;

        $tenants->save();
        return redirect()->route('Dashboard.parte_administrativa.tenants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tenants = Tenant::findOrFail($id);
        $tenants->delete();
        return redirect()->route('Dashboard.parte_administrativa.tenants.index');
    }

    public function admin(){
        return view('Dashboard.inicio_dashboardAdmin');
    }
}
