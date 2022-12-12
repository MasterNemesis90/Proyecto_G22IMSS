<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;

class ControllerServicios extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servi = Servicios::all();
       return view('Dashboard.paginas.Servicios.index',compact('servi'));
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
        $ser = new Servicios();
        $ser->id_tenant = auth()->user()->id_tenant;
        $ser->nombre_servicio = $request->nombre;
        $ser->precio = $request->precio;
        $ser->descripcion_servicio = $request->descripcion_servicio;

        $ser->save();

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
        $servicio = Servicios::find($id);

        return view('Dashboard.paginas.Servicios.edit',compact('servicio'));
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
        $ser = Servicios::find($id);
        // $ser->id_tenant = 1;
        $ser->nombre_servicio = $request->nombreN;
        $ser->precio = $request->precioN;
        $ser->descripcion_servicio = $request->descripcion_servicioN;

        $ser->save();

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
        $ser = Servicios::find($id);
        $ser->delete();
        return back();
    }
}
