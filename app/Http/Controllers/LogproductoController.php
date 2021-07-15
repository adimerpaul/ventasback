<?php

namespace App\Http\Controllers;

use App\Models\Logproducto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogproductoController extends Controller
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
     * @param  \App\Models\Logproducto  $logproducto
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request){}
    public function verdatos(Request $request)
    {
        //
        return DB::table('logproductos')
        ->select('logproductos.cantidad as cantidad','logproductos.detalle as detalle','logproductos.fecha as fecha','users.name as name')
        ->join('users','users.id','=','logproductos.user_id')
        ->where('logproductos.product_id',$request->id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logproducto  $logproducto
     * @return \Illuminate\Http\Response
     */
    public function edit(Logproducto $logproducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logproducto  $logproducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logproducto $logproducto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logproducto  $logproducto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logproducto $logproducto)
    {
        //
    }
}
