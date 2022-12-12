<?php

namespace App\Http\Controllers;

use App\Models\Soporte;
use Illuminate\Http\Request;

class ControllerSoporte extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $soporte = Soporte::all();
        return view('Dashboard.parte_administrativa.soporte.index', compact('soporte'));
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
        //
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
        $soporte = Soporte::findOrFail($id);
        return view('Dashboard.parte_administrativa.soporte.edit', compact('soporte'));
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
         $soporte = Soporte::findOrFail($id);
         $soporte->fecha_soporte = $request->fecha_soporte;
         $soporte->descripcion = $request->descripcion;
         $soporte->atendido = $request->atendido;

         $soporte->save();
         return redirect()->route('Dashboard.parte_administrativa.soporte.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $soporte = Soporte::findOrFail($id);
        $soporte->delete();
        return redirect()->route('Dashboard.parte_administrativa.soporte.index');
    }

    public function correo()
    {
        return view('Dashboard.parte_administrativa.soporte.correo');
    }

    public function zoom()
    {
        return view('Dashboard.parte_administrativa.soporte.zoom');

    }
}
