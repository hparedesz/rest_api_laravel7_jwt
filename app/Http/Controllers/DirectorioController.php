<?php

namespace App\Http\Controllers;

//importar
use App\Directorio;
use App\Http\Requests\CreateDirectorioRequest;
use App\Http\Requests\UpdateDirectorioRequest;
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

    private function cargarArchivo($file){
        //obtener el nombre y la extension del archivo
        $nombreArchivo= time().'.'.$file->getClientOriginalExtension();
        //se movera a la carpera publica
        $file->move(public_path('fotografias'),$nombreArchivo);
        return $nombreArchivo;
    }

    //metodo para insertar datos
    public function store(CreateDirectorioRequest $request)
    {
        //capturamos los datos
        $input= $request->all();

        //si tiene el parametro foto
        if($request->has('foto')){
            $input['foto']=$this->cargarArchivo($request->foto);
        }
        Directorio::create($input);
        return response()->json([
            'res'=>true,
            'message'=>'Registro creado correctamente'
        ],200);
    }

    //retorna un solo registro
    public function show(Directorio $directorio)
    {
        return $directorio;
    }

    //put actualizar datos
    public function update(UpdateDirectorioRequest $request, Directorio $directorio)
    {
        $input = $request->all();
        //si tiene el parametro foto
        if($request->has('foto')){
            $input['foto']=$this->cargarArchivo($request->foto);
        }
        $directorio->update($input);
        return response()->json([
            'res'=>true,
            'message'=>'Registro actualizado correctamente'
        ],200);
    }

    //delete eliminar registros
    public function destroy($id)
    {
        Directorio::destroy($id);
        return response()->json([
            'res'=>true,
            'message'=>'Registro eliminado correctamente'
        ],200);
    }
}
