<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Detail;
use App\Models\Dosage;
use App\Models\Empresa;
use App\Models\Product;
use App\Models\Anulado;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        require('codigocontrol/CodigoControlV7.php');
//        $numero_autorizacion = '29040011007';
//        $numero_factura = '1503';
//        $nit_cliente = '4189179011';
//        $fecha_compra = '20070702';
//        return $request->monto;
//        $monto_compra = '2500';
//        $clave = '9rCB7Sv4X29d)5k7N%3ab89p-3(5[A';
        $dosage=Dosage::where('empresa_id',$request->user()->empresa_id)->where('activo',1)->whereDate('hasta','>=',now())->whereDate('desde','<=',now())->get();
        $empresa=Empresa::where('id',$request->user()->empresa_id)->firstOrFail();
//        return $dosage[0]->nroautorizacion;
        if ($dosage->count()==0){
            $dosage=Dosage::where('empresa_id',$request->user()->empresa_id)->whereDate('hasta','>=',now())->whereDate('desde','<=',now())->get();
            if ($dosage->count()==1){
                 $id=$dosage[0]->id;
                 $dosage=Dosage::find($id);
                 $dosage->update([
                     'activo'=>1
                 ]);
                 $dosage->save();
                DB::table('dosages')
                    ->where('id','!=',$dosage->id)
                    ->where('empresa_id',$request->user()->empresa_id)
                    ->update(['activo'=>0]);
//                 $dosage[0]=$dosage;
            }else{
                return response()->json(['res'=>'Sin empresa activada'],400);
            }
        }else{
            $id=$dosage[0]->id;
            $dosage=Dosage::find($id);
        }
        $client=Client::where('cinit',$request->cinit)->get();
//        return $client->count();
        if ($client->count()==0){
//            return 'a';
            $client=new Client();
            $client->cinit=$request->cinit;
            $client->nombrerazon=$request->nombrerazon;
            $client->save();
        }else{
            $id=$client[0]->id;
//            return $id;
            $client=Client::find($id);
            $client->update([
                'cinit'=>$request->cinit,
                'nombrerazon'=>$request->nombrerazon
            ]);
            $client->save();
//            return $client;
        }
        if ($request->cinit==0){
            $tipo='R';
        }else{
            $tipo='F';
        }
        if ($request->delivery=='' || $request->delivery==null){
            $delivery='';
        }else{
            $delivery=$request->delivery;
        }
        if ($tipo=='F'){
            $numero_autorizacion = $dosage->nroautorizacion;
            $numero_factura = $dosage->nrofactura;
            $dosage->nrofactura=$dosage->nrofactura+1;
            $dosage->save();
            $nit_cliente = $request->cinit;
            $fecha_compra = date('Ymd');
            $monto_compra = (int)$request->total;
            $clave = $dosage->llave;
            $codigo = New \CodigoControlV7();
            $codigocontrol=$codigo::generar($numero_autorizacion, $numero_factura, $nit_cliente, $fecha_compra, $monto_compra, $clave);
            $sale=new Sale();
            $sale->fecha=date('Y-m-d');
            $sale->total=$request->total;
            $sale->tipo=$tipo;
            $sale->codigocontrol=$codigocontrol;
            $codigoqr= $empresa->nit."|".$numero_factura.'|'.$numero_autorizacion.'|'.date('Ymd').'|'.$monto_compra.'|'.$monto_compra.'|'.$codigocontrol.'|'.$request->cinit.'|0|0|0|0.00';
            $sale->codigoqr=$codigoqr;
            $sale->delivery=$delivery;
            $sale->nrocomprobante=$numero_factura;
            $sale->monto=$request->monto;
            $sale->user_id=$request->user()->id;
            $sale->dosage_id=$dosage->id;
            $sale->client_id=$client->id;
            $sale->save();
        }else{
//            $numero_autorizacion = $dosage->nroautorizacion;
//            $numero_factura = $dosage->nrofactura;
//            $dosage->nrofactura=$dosage->nrofactura+1;
//            $dosage->save();
//            $nit_cliente = $request->cinit;
//            $fecha_compra = date('Ymd');
//            $monto_compra = (int)$request->monto;
//            $clave = $dosage->llave;
//            $codigo = New \CodigoControlV7();
//            $codigocontrol=$codigo::generar($numero_autorizacion, $numero_factura, $nit_cliente, $fecha_compra, $monto_compra, $clave);
//
            $sale=new Sale();
            $sale->fecha=date('Y-m-d');
            $sale->total=$request->total;
            $sale->tipo=$tipo;
            $sale->codigocontrol='';
//            $codigoqr= $empresa->nit."|".$numero_factura.'|'.$numero_autorizacion.'|'.date('Ymd').'|'.$monto_compra.'|'.$monto_compra.'|'.$codigocontrol.'|'.$request->cinit.'|0|0|0|0.00';
            $sale->codigoqr='';
            $sale->delivery=$delivery;
            $sale->nrocomprobante='';
            $sale->monto=$request->monto;
            $sale->user_id=$request->user()->id;
            $sale->dosage_id=$dosage->id;
            $sale->client_id=$client->id;
            $sale->save();
        }
//        return $request->delivery;
        foreach ($request->details as $row){
//            echo $row['product_id'].'<br>';
            $product=Product::find($row['product_id']);
            $product->cantidad=$product->cantidad-$row['cantidad'];
            $product->save();

            $detail=new Detail();
            $detail->sale_id=$sale->id;
            $detail->user_id=$request->user()->id;
            $detail->product_id=$row['product_id'];
            $detail->cantidad=$row['cantidad'];
            $detail->nombreproducto=$row['nombre'];
            $detail->precio=$row['precio'];
            $detail->subtotal=$row['subtotal'];
            $detail->save();
        }

//        return '45465';
//        return $codigoqr;
//        return $codigocontrol;
//        return CodigoControlV7::generar($numero_autorizacion, $numero_factura, $nit_cliente, $fecha_compra, $monto_compra, $clave);
///
        $this->recibo($sale->id);
    }
    public function recibo($id){
        echo "FACTURA $id";
    }

    public function buscar($fecha){
        return Sale::with('user')->with('client')->with('details')->where('fecha',$fecha)->get();
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

    public function anular(Request $request){
        $sale=Sale::find($request->id);
        $sale->estado='ANULADO';
        $sale->total=0;
        $sale->save();

        $anular=array(
        'motivo'=>$request->motivo,
        'user_id'=>$request->user_id,
        'sale_id'=>$request->id);
        return Anulado::create($anular);
    }

    public function imprimir(){
        
    }

    public function resumen(Request $request){
        $id=$request->id;
        $fecha=$request->fecha;
        return Sale::with('client')->where('user_id',$id)->where('fecha',$fecha)->get();
    }

    public function resproducto(Request $request){
        $id=$request->id;
        $fecha=$request->fecha;
        return DB::table('details')
        ->select('product_id','nombreproducto', DB::raw('SUM(cantidad) as cant'),'precio',DB::raw('SUM(subtotal) as total'))
        ->join('sales','sales.id','=','details.sale_id')
        ->where('sales.user_id',$id)
        ->where('sales.fecha',$fecha)
        ->where('sales.estado','ACTIVO')
        ->groupBy('product_id','nombreproducto','precio')
        ->get();
    }

    public function libro(Request $request){
        return DB::select('        
        SELECT fecha,nrocomprobante,d.nroautorizacion,IF(estado="ACTIVO","V","A") as estado,cinit,c.nombrerazon, 
        "0" as ice, "0" as exenta,"0" as tasa,"0" as rebaja,(total * 0.13) as fiscal, codigocontrol,total
        FROM sales s
        INNER JOIN dosages d ON d.id=s.dosage_id
        INNER JOIN clients c ON s.client_id=c.id
        WHERE MONTH(s.fecha)="'.$request->mes.'" AND YEAR(s.fecha)="'.$request->anio.'" 
        AND s.tipo="F" 
        ORDER BY s.id asc');
    }
}
