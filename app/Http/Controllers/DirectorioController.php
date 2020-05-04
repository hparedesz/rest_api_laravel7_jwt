<?php

namespace App\Http\Controllers;

//importar
use App\Directorio;
use Illuminate\Http\Request;

class DirectorioController extends Controller
{
    //listar registros
    public function index(Request $request)
    {
        //si existe el parametro buscar en la url 
        if($request->has('buscar')){
            $directorios=Directorio::where('nombre','like','%'.$request->buscar.'%')
            ->orWhere('telefono',$request->buscar)
            ->get();
        }else{
            $directorios=Directorio::all();
        }
        return $directorios;
    }

    //metodo para insertar datos
    public function store(Request $request)
    {
        //capturamos los datos
        $input= $request->all();
        Directorio::create($input);
        return response()->json([
            'res'=>true,
            'message'=>"Registro creado correctamente"
        ],200);
    }

    //retorna un solo registro
    public function show(Directorio $directorio)
    {
        return $directorio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
