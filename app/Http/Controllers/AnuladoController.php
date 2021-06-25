<?php

namespace App\Http\Controllers;

use App\Models\Anulado;
use Illuminate\Http\Request;

class AnuladoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Anulado  $anulado
     * @return \Illuminate\Http\Response
     */
    public function show(Anulado $anulado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Anulado  $anulado
     * @return \Illuminate\Http\Response
     */
    public function edit(Anulado $anulado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Anulado  $anulado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anulado $anulado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anulado  $anulado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anulado $anulado)
    {
        //
    }

    public function listado($fecha){
        return Anulado::with('user')->with('sale')->where('fecha',$fecha)->get();
    }
}
