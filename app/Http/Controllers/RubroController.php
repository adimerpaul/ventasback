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
    public function upload(Request $request){
        $this->validate($request, [
            'imagen'=>'required'
        ]);
//        return $request->imagen;
        if ($request->hasFile('imagen')) {
//            return "si";
            $file=$request->file('imagen');
            $nombreArchivo = time().".".$file->getClientOriginalExtension();
//        return $nombreArchivo;
            $file->move(\public_path('imagenes'), $nombreArchivo);
            return $nombreArchivo;
        }
//        else{
//            return "no";
//        }
//        return 'a';
//        $request->validate([
//            'file_path'=>'required'
//        ]);
//        $validated = $request->validate([
//            'file_path' => 'required',
//        ]);
//        return hash_file();
//        try {
//            $file_original_path = (object) ['file_path' => ""];
//
//
//            if ($request->hasFile('file_path')) {
//                $original_filename = $request->file('file_path')->getClientOriginalName();
//                $original_filename_arr = explode('.', $original_filename);
//                $file_ext = end($original_filename_arr);
//                $destination_path = './uploads/files/';
//                $file_path_name = 'C-' . time() . '.' . $file_ext;
//
//                if ($request->file('file_path')->move($destination_path, $file_path_name )) {
//
//                    $uploadPath = '/uploads/files/'.$file_path_name ;
//
//
//                    return response() -> json(['path'=>$uploadPath, 'message' => 'File has been Successfully Uploaded'], 201);
//                } else {
//                    return response() -> json('Cannot upload file');
//                }}
//        } catch (Exception $e) {
//            throw new NotFoundException('Upload Failed');
//        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        if ($request->file('imagen'))
//        $file=$request->file('imagen');
//
//        $nombreArchivo = time().".".$file->getClientOriginalExtension();
////        return $nombreArchivo;
//        $ruta=$file->move(\public_path('imagenes'), $nombreArchivo);
        $input=$request->all();
//        $input['imagen']=$ruta;
        $rubro=Rubro::create($input);
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
