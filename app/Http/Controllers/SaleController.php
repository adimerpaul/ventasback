<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Detail;
use App\Models\Dosage;
use App\Models\Empresa;
use App\Models\Product;
use App\Models\Anulado;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Luecano\NumeroALetras\NumeroALetras;
use Picqer\Barcode\BarcodeGeneratorPNG;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
//use CodeItNow\BarcodeBundle\Utils\QrCode;

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
//        return Empresa::all();
//        exit;

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
            $cobrar=false;
        }else{
            $delivery=$request->delivery;
            $cobrar=true;
        }

        if ($tipo=='F'){
            $numero_autorizacion = $dosage->nroautorizacion;
            $numero_factura = $dosage->nrofactura;
            $dosage->nrofactura=$dosage->nrofactura+1;
            $dosage->save();
            $nit_cliente = $request->cinit;
//            $fecha_compra = date('Ymd');
//            $date = new Date($request->fecha);
//            $fc =$date->format('Ymd');
//            $fecha_compra =date_format($request->fecha, 'Ymd');
             $date = date_create($request->fecha);
//            return  date_format($date, 'Ymd');;
            $fecha_compra =date_format($date, 'Ymd');
            $monto_compra = round($request->total);
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
            $sale->cobrar=$cobrar;
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
//          return "RECIBO";
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
//            return $sale;
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
//            return $detail;
        }

//        return '45465';
//        return $codigoqr;
//        return $codigocontrol;
//        return CodigoControlV7::generar($numero_autorizacion, $numero_factura, $nit_cliente, $fecha_compra, $monto_compra, $clave);
///
        if ($tipo=='F'){
            $this->factura($sale,$dosage,$client,$empresa);
        }else{
//            $this->factura($sale,$dosage,$client,$empresa);
            echo 1;
        }

    }
    public function factura($sale,$dosage,$client,$empresa){
//        echo "FACTURA $sale->id";
//        $empresa=Empresa::all();
//        return $empresa->nombre;
//        echo "as";
//        exit();
//        exit;
        $cadena = "
            <style>.margen{padding: 0px 15px 0px 15px;}
            .textoimp{ font-size: small; text-align: center;}
            .textor{ font-size: small; text-align: right;}
            .textmed{ font-size: small; text-align: left;}
            table{border: 0px solid #000; text-align:center; align:center; width: 100% }
            th,td{font-size: small;}
            hr{border: 1px dashed ;}</style>
            <div class='textoimp margen'>
            <span>$empresa->nombre</span><br>
            <span>SUCURSAL No 1</span><br>
            <span>$empresa->direccion</span><br>
            <span>Tel: $empresa->telefono</span><br>
            <span>ORURO - BOLIVIA</span><br>
            <hr>
            <span>FACTURA</span><br>
            <span>NIT: $empresa->nit</span><br>
            <span>Nro FACTURA:$sale->nrocomprobante</span><br>
            <span>Nro AUTORIZACION: $dosage->nroautorizacion</span><br>
            <hr>
            ";
        $cadena.="<div class='textmed'>Fecha: $sale->fecha<br>
            Señor(es): $client->nombrerazon<br>
            NIT/CI: $client->cinit
            <hr></div>";
        $cadena.="<table><thead><tr>
                <th>DESC</th>              <th>CANT</th>     <th>P.U.</th>           <th>IMP</th><tr></thead>
                <tbody>";
        $details=Detail::where('sale_id',$sale->id)->get();
//        $cadena.=$details->count();
        foreach ($details as $row){
            $nombrep=$row->nombreproducto;
            $precio=$row->precio;
            $cantidad=$row->cantidad;
            $subtotal=$row->subtotal;
            $cadena.="<tr><td>$nombrep</td><td>$cantidad</td><td>$precio</td><td>$subtotal</td></tr>";
//            $total=$total+$subtotal;

        }
        $cadena.="</tbody></table>";

        $total=number_format($sale->total,2);
        $d = explode('.',$sale->total);
        $entero=$d[0];
        $decimal=$d[1];
        $formatter = new NumeroALetras();

        $cadena.=("<div class='textor'>SUBTOTAL: $sale->total Bs.<br>");
        //$cadena.=("DESC:   0.00 Bs.<br>");
        $cadena.=("TOTAL: $sale->total Bs.</div>");


        $cadena.="<div class='textmed'>SON: ".$formatter->toWords($entero)." $decimal/100 Bolivianos</div>
    <hr>
    <div class='textmed'>
    Cod. de Control: $sale->codigocontrol <br>
    Fecha Lim. de Emision: ". date("d/m/Y", strtotime($dosage->hasta)) ."<br></div>";

        //
        $user=User::where('id',$sale->user_id)->firstOrFail();

        $qrCode = new \CodeItNow\BarcodeBundle\Utils\QrCode();
        $qrCode
            ->setText($sale->codigoqr)
            ->setSize(125);
//            ->setPadding(10)
//            ->setErrorCorrection('high')
//            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
//            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
//            ->setLabel('Scan Qr Code')
//            ->setLabelFontSize(16)
//            ->setImageType(QrCode::IMAGE_TYPE_PNG);

        $imagen= '<img src="data:'.$qrCode->getContentType().';base64,'.$qrCode->generate().'" />';

//        $generator = new BarcodeGeneratorPNG();
//        $imagen= '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode('081231723897', $generator::TYPE_CODE_128)) . '">';
//        $png = QrCode::format('png')->size(512)->generate(1);
//        $png = base64_encode($png);
//        $imagen= "<img src='data:image/png;base64," . $png . "'>";

        $cadena.="<small class='textoimp'>$imagen</small><br>";
        $cadena.="<small> ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAIS. EL USO ILICITO DE ESTA SERA SANCIONADO DE ACUERDO A LEY <br>
    </small>";
        $cadena.="<div class='textoimp'> <span>$dosage->leyenda</span></div>";
        $cadena.="<div class='textmed'> <span> PUNTO: ".gethostname()."</span></div>";
        $cadena.="<div class='textmed'> <span> USUARIO: ".$user->name."</span></div>";
        $cadena.="<div class='textmed'> <span> NUMERO: $sale->id</span></div>";
//        $cadena.="<div class='textmed'> <span> VUELTO: ".($cancelado-$total)."</span></div></div>";

        echo $cadena;

    }

    public function buscar($fecha){
        return Sale::with('user')->with('client')->with('details')->where('fecha',$fecha)->get();
    }

    public function buscar2(Request $request){
        return Sale::with('user')->with('client')->with('details')
        ->where('delivery',$request->deliveri)
        ->whereMonth('fecha',$request->mes)->whereYear('fecha',$request->anio)->get();
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
        SELECT (@numero:=@numero+1) as nro,fecha,nrocomprobante,d.nroautorizacion,IF(estado="ACTIVO","V","A") as estado,cinit,c.nombrerazon,
        "0" as ice, "0" as exenta,"0" as tasa,"0" as rebaja,(total * 0.13) as fiscal, codigocontrol,total
        FROM sales s
        cross join (select @numero := 0) r
        INNER JOIN dosages d ON d.id=s.dosage_id
        INNER JOIN clients c ON s.client_id=c.id
        WHERE MONTH(s.fecha)="'.$request->mes.'" AND YEAR(s.fecha)="'.$request->anio.'"
        AND s.tipo="F"
        ORDER BY s.id asc');
    }

    public function libro2(Request $request){
        return DB::select('
        SELECT (@numero:=@numero+1) as nro,fecha,nrocomprobante,d.nroautorizacion,IF(estado="ACTIVO","V","A") as estado,cinit,c.nombrerazon,
        "0" as ice, "0" as exenta,"0" as tasa,"0" as rebaja,(total * 0.13) as fiscal, codigocontrol,total
        FROM sales s
        cross join (select @numero := 0) r
        INNER JOIN dosages d ON d.id=s.dosage_id
        INNER JOIN clients c ON s.client_id=c.id
        WHERE s.fecha="'.$request->fecha.'"
        AND s.tipo="F"
        ORDER BY s.id asc');
    }

    public function imprimirresumen(Request $request){
        $id=$request->id;
        $fecha=$request->fecha;
        $empresa= Empresa::find(1);
        $usuario=User::find($id);
        $detalle=DB::table('details')
        ->select('product_id','nombreproducto', DB::raw('SUM(cantidad) as cant'),'precio',DB::raw('SUM(subtotal) as total'))
        ->join('sales','sales.id','=','details.sale_id')
        ->where('sales.user_id',$id)
        ->where('sales.fecha',$fecha)
        ->where('sales.estado','ACTIVO')
        ->groupBy('product_id','nombreproducto','precio')
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
                Fecha Caja: ".$fecha."<br>";

        $cadena.="Usuario:$usuario->name<br>
                 <hr><br></div>
                 <center>
                 <table class='table'>
                 <thead>
                 <tr>
                <th>DESCRIPCION</th> <th>CANTIDAD</th><th>P.U.</th><th>TOTAL</th></tr>
                </thead><tbody>";
        $total=0;

        foreach ($detalle as $row){

            $cadena.="<tr><td>$row->nombreproducto</td><td>$row->cant</td><td>$row->precio</td><td>$row->total</td></tr>";
            $total=$total+$row->total;
        }
        $cadena.="</tbody></table></center>";

        $total=number_format($total,2);
        $d = explode('.',$total);
        $entero=$d[0];
        $decimal=$d[1];
        $cadena.="<hr>";
        $cadena.="<br><div class='textor'>TOTAL: $total Bs.</div><br>";
        $formatter = new NumeroALetras();

        $cadena.="  SON: ".$formatter->toWords($entero)." $decimal/100 Bolivianos<br>";

        $cadena.= "<br><br><br><span style='font-size: x-small;'>ENTREGE CONFORME &nbsp; &nbsp; &nbsp; &nbsp;  RECIBI CONFORME<span></div>";
        return $cadena;
    }

    public function informe(Request $request){
        $ini=$request->ini;
        $fin=$request->fin;
        return DB::table('details')
        ->select('product_id','nombreproducto', DB::raw('SUM(cantidad) as cant'),'precio',DB::raw('SUM(subtotal) as total'))
        ->join('sales','sales.id','=','details.sale_id')
        ->where('sales.fecha',">=",$ini)
        ->where('sales.fecha','<=',$fin)
        ->where('sales.estado','ACTIVO')
        ->groupBy('product_id','nombreproducto','precio')
        ->get();
    }
}
