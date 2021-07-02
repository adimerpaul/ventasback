<?php

namespace App\Http\Controllers;

use App\Models\Deliveri;
use Illuminate\Http\Request;

class DeliveriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Deliveri::all();
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
        $deliveri=Deliveri::create($request->all());
        return $deliveri;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deliveri  $deliveri
     * @return \Illuminate\Http\Response
     */
    public function show(Deliveri $deliveri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deliveri  $deliveri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deliveri $deliveri)
    {
        //
        $deliveri->update($request->all());
        return $deliveri;
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deliveri  $deliveri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deliveri $deliveri)
    {
        //
    }
}
