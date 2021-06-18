<?php

namespace App\Http\Controllers;

use App\Models\Dosage;
use Illuminate\Http\Request;

class DosageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Dosage::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dosage=Dosage::create($request->all());
        return $dosage;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dosage  $dosage
     * @return \Illuminate\Http\Response
     */
    public function show(Dosage $dosage)
    {
        return $dosage;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dosage  $dosage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosage $dosage)
    {
        $dosage->update($request->all());
        return $dosage;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dosage  $dosage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dosage=Dosage::find($id);
        $dosage->delete();
        return response()->json(['res'=>'Borrado exitoso'],200);
    }

    public function validar(){
        //deshabilitar las vencidas
        //debe de haber solo 1 activo
        //si no ay activo verificar si existe alguno en fecha y activarlo 
        // sino cumple alguno no se factura 
        $res=Dosage::find()->where('hasta','<',curdate())->where('activo',true);
    } 
}
