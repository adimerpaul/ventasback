<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Logproducto;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::with('rubro')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product=Product::create($request->all());
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        $product->delete();
        return response()->json(['res'=>'Borrado exitoso'],200);
    }

    public function productadd(Request $request){
        $log=new Logproducto();
        $log->cantidad=$request->cantidad;
        $log->product_id=$request->id;
        $log->fecha=date('Y-m-d H:i:s');
        $log->user_id=$request->user()->id;
        $log->detalle='Agrega mas Producto';
        $log->save();

        $product=Product::find($request->id);
        $product->cantidad+=$request->cantidad;
        return $product->save();
    }

    public function productsub(Request $request){
        $log=new Logproducto();
        $log->cantidad=$request->cantidad;
        $log->product_id=$request->id;
        $log->estado=false;
        $log->fecha=date('Y-m-d H:i:s');
        $log->user_id=$request->user()->id;
        $log->detalle='Correccion Producto';
        $log->save();

        $product=Product::find($request->id);
        if($product->cantidad < $request->cantidad)
            $product->cantidad=0;
        else
            $product->cantidad-=$request->cantidad;
        return $product->save();
    }
}
