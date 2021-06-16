<?php

namespace App\Http\Controllers;

use App\Models\Rubro;
use Illuminate\Http\Request;

class RubroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Rubro::with('products')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rubro=Rubro::create($request->all());
        return $rubro;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function show(Rubro $rubro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rubro $rubro)
    {
        $rubro->update($request->all());
        return $rubro;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rubro $rubro)
    {
        $rubro->delete();
        return response()->json(['res'=>'Borrado exitoso'],200);
    }
}
