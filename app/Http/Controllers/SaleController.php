<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Detail;
use App\Models\Dosage;
use App\Models\Empresa;
use App\Models\Sale;
use Illuminate\Http\Request;


class SaleController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        require('codigocontrol/CodigoControlV7.php');
//
//        $dosage=Dosage::where('empresa_id',$request->user()->empresa_id)->where('activo',1)->whereDate('hasta','>=',now())->whereDate('desde','<=',now())->get();
//        $empresa=Empresa::where('id',$request->user()->empresa_id)->firstOrFail();
////        return $dosage[0]->nroautorizacion;
//        if ($dosage->count()==0){
//            return response()->json(['res'=>'Sin empresa activada'],200);
//        }
//        $client=Client::where('cinit',$request->cinit)->get();
////        return $client->count();
//        if ($client->count()==0){
////            return 'a';
//            $client=new Client();
//            $client->cinit=$request->cinit;
//            $client->nombrerazon=$request->nombrerazon;
//            $client->save();
//        }else{
//            $id=$client[0]->id;
////            return $id;
//            $client=Client::find($id);
//            $client->update([
//                'cinit'=>$request->cinit,
//                'nombrerazon'=>$request->nombrerazon
//            ]);
//            $client->save();
////            return $client;
//        }
//        if ($request->cinit==0){
//            $tipo='R';
//        }else{
//            $tipo='F';
//        }
//        if ($request->delivery=='' || $request->delivery==null){
//            $delivery='';
//        }else{
//            $delivery=$request->delivery;
//        }
//        $numero_autorizacion = $dosage[0]->nroautorizacion;
//        $numero_factura = $dosage[0]->nrofactura;
//        $dosage[0]->nrofactura=$dosage[0]->nrofactura+1;
//        $dosage[0]->save();
//        $nit_cliente = $request->cinit;
////        $fecha_compra = '20070702';
//        $fecha_compra = date('Ymd');
//        $monto_compra = (int)$request->monto;
//        $clave = $dosage[0]->llave;
////        $numero_autorizacion = '29040011007';
////        $numero_factura = '1503';
////        $nit_cliente = '4189179011';
////        $fecha_compra = '20070702';
////        return $request->monto;
////        $monto_compra = '2500';
////        $clave = '9rCB7Sv4X29d)5k7N%3ab89p-3(5[A';
//        $codigo = New \CodigoControlV7();
//        $codigocontrol=$codigo::generar($numero_autorizacion, $numero_factura, $nit_cliente, $fecha_compra, $monto_compra, $clave);
////        return $codigocontrol;
//        $sale=new Sale();
//        $sale->fecha=date('Y-m-d');
//        $sale->total=(int)$request->monto;
//        $sale->tipo=$tipo;
//        $sale->codigocontrol=$codigocontrol;
////        return 99;
//        $codigoqr= $empresa->nit."|".$numero_factura.'|'.$numero_autorizacion.'|'.date('Ymd').'|'.$monto_compra.'|'.$monto_compra.'|'.$codigocontrol.'|'.$request->cinit.'|0|0|0|0.00';
//        $sale->codigoqr=$codigoqr;
//        $sale->delivery=$delivery;
//        $sale->nrocomprobante=$numero_factura;
//        $sale->monto=$monto_compra;
//        $sale->user_id=$request->user()->id;
//        $sale->dosage_id=$dosage[0]->id;
//        $sale->client_id=$client->id;
//        $sale->save();
////        return $request->delivery;
//        foreach ($request->details as $row){
////            echo $row['product_id'].'<br>';
//            $detail=new Detail();
//            $detail->sale_id=$sale->id;
//            $detail->user_id=$request->user()->id;
//            $detail->product_id=$row['product_id'];
//            $detail->cantidad=$row['cantidad'];
//            $detail->nombreproducto=$row['nombre'];
//            $detail->precio=$row['precio'];
//            $detail->subtotal=$row['subtotal'];
//            $detail->save();
//        }
//
////        return '45465';
////        return $codigoqr;
////        return $codigocontrol;
////        return CodigoControlV7::generar($numero_autorizacion, $numero_factura, $nit_cliente, $fecha_compra, $monto_compra, $clave);
        $this->recibo(45);
    }
    public function recibo($id){
        echo "FACTURA $id";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
