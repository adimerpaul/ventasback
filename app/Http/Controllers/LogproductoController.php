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
        $empresa=Empresa::where('id',$request->user()->empresa_id)->firstOrFail();
        $logproductos=Logproducto::whereDate('fecha','>=',$request->inicio)
            ->whereDate('fecha','<=',$request->fin)
            ->with('user')
            ->with('product')
            ->get();
        $cadena="<style>
        .margen{padding: 0px 15px 0px 15px;}
        .textoimp{ font-size: small; text-align: center;}
        .textor{ font-size: small; text-align: right;}
        .textmed{ font-size: small; text-align: left;}
        table{border: 1px solid #000; text-align:left; align:center; }
        th,td{font-size: x-small;}
        hr{border: 1px dashed ;}</style>
        <div class='textoimp margen'>
        <span>$empresa->nombre</span><br>
        <span>$empresa->direccion</span><br>
        <span>Tel: $empresa->telefono</span><br>
        <span>ORURO - BOLIVIA</span><br>
        <span>TOTAL VENTA</span><br>
        <hr>
        ";
        $cadena.="<div class='textmed'>Fecha: ".date('Y-m-d H:m:s')."<br>
                DE : ".$request->inicio." AL ".$request->fin."<br>";
        $cadena.="Usuario:".$request->user()->name."<br>
                 <hr><br></div>
                 <center>
                 <table class='table'>
                 <thead>
                 <tr>
                <th>Producto</th> <th>CANTIDAD</th><th>Descripcion</th><th>Fecha</th><th>Usuario</th></tr>
                </thead><tbody>";
        $total=0;

        foreach ($logproductos as $row){

            $cadena.="<tr><td>".$row->product->nombre."</td><td>$row->cantidad</td><td>$row->detalle</td><td>$row->fecha</td><td>".$row->user->name."</td></tr>";
//            $total=$total+$row->total;
        }
        $cadena.="</tbody></table></center>";

//        $total=number_format($total,2);
//        $d = explode('.',$total);
//        $entero=$d[0];
//        $decimal=$d[1];
//        $cadena.="<hr>";
//        $cadena.="<br><div class='textor'>TOTAL: $total Bs.</div><br>";
//        $formatter = new NumeroALetras();
//
//        $cadena.="  SON: ".$formatter->toWords($entero)." $decimal/100 Bolivianos<br>";

        $cadena.= "<br><br><br><span style='font-size: x-small;'>ENTREGE CONFORME &nbsp; &nbsp; &nbsp; &nbsp;  RECIBI CONFORME<span></div>";
        return $cadena;
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
