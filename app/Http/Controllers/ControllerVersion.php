<?php

namespace App\Http\Controllers;

use App\Models\Version;
use Illuminate\Http\Request;

class ControllerVersion extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $versiones = Version::all();
        return view('Dashboard.parte_administrativa.versiones.index', compact('versiones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.parte_administrativa.versiones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $versiones = new Version();
         $versiones->fecha_actualizacion = $request->fecha_actualizacion;
         $versiones->nombre_version = $request->nombre_version;


        $versiones->save();
        return redirect()->route('Dashboard.parte_administrativa.versiones.index');
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
        $versiones = Version::findOrFail($id);
        return view('Dashboard.parte_administrativa.versiones.edit', compact('versiones'));
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
        $versiones = Version::findOrFail($id);
         $versiones->fecha_actualizacion = $request->fecha_actualizacion;
         $versiones->nombre_version = $request->nombre_version;


        $versiones->save();
        return redirect()->route('Dashboard.parte_administrativa.versiones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $versiones = Version::findOrFail($id);
        $versiones->delete();
        return redirect()->route('Dashboard.parte_administrativa.versiones.index');
    }
}
