<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Client::all();
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
        if(Client::find($request->cinit))
        return response()->json(['res'=>'Cliente ya registrado'],406);
        $client=Client::create($request->all());
        return $client;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($ci)
    {
        return Client::where('cinit',$ci)->get() ;
        //
//        return $client;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $client=Client::find($request->id);
        $client->update(['nombrerazon'=>$request->nombrerazon]);
        return $client;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $client=Client::find($id);
        $client->delete();
        return response()->json(['res'=>'Borrado exitoso'],200);
    }

    public function lista($ci){
        return Client::where('cinit','like',$ci.'%')->limit(10)->get();
    }
}
