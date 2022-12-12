<?php

namespace App\Http\Controllers;

use App\Models\Formas_de_Pago;
use App\Models\Tenant;
use Illuminate\Http\Request;

class ControllerFormas_de_Pago extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formas_pagos = Formas_de_Pago::all();
        return view('Dashboard.parte_administrativa.formas_pagos.index', compact('formas_pagos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tenants = Tenant::all();
        return view('Dashboard.parte_administrativa.formas_pagos.create', compact('tenants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formas_pagos = new Formas_de_Pago();
         $formas_pagos->nombre = $request->nombre;
         $formas_pagos->descripcion = $request->descripcion;
         $formas_pagos->tarifa = $request->tarifa;
         $formas_pagos->id_tenant = $request->id_tenant;


        $formas_pagos->save();
        return redirect()->route('Dashboard.parte_administrativa.formas_pagos.index');
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
        $formas_pagos = Formas_de_Pago::findOrFail($id);
        $tenants = Tenant::all();
        return view('Dashboard.parte_administrativa.formas_pagos.edit', compact('formas_pagos','tenants'));
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
        $formas_pagos = Formas_de_Pago::findOrFail($id);
         $formas_pagos->nombre = $request->nombre;
         $formas_pagos->descripcion = $request->descripcion;
         $formas_pagos->tarifa = $request->tarifa;
         $formas_pagos->id_tenant = $request->id_tenant;


        $formas_pagos->save();
        return redirect()->route('Dashboard.parte_administrativa.formas_pagos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $formas_pagos = Formas_de_Pago::findOrFail($id);
        $formas_pagos->delete();
        return redirect()->route('Dashboard.parte_administrativa.formas_pagos.index');
    }
}
