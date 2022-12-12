<?php

namespace App\Http\Controllers;

use App\Models\Sugerencia;
use Illuminate\Http\Request;

class ControllerSugerencia extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sugerencias = Sugerencia::all();
        return view('sugerencia.index', compact('sugerencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sugerencia.create');
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
        $sugerencias = Sugerencia::findOrFail($id);
        return view('sugerencia.edit', compact('sugerencias'));
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
         $sugerencias = Sugerencia::findOrFail($id);
         $sugerencias->fecha_sugerencia = $request->fecha_sugerencia;
         $sugerencias->sugerencia = $request->sugerencia;


        $sugerencias->save();
        return redirect()->route('sugerencia.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sugerencias = Sugerencia::findOrFail($id);
        $sugerencias->delete();
        return redirect()->route('sugerencias.index');
    }

    public function responder()
    {
        return view('sugerencias.index');
    }
}
