<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function store(Request $request)
    {
        //capturamos los datos
        $input= $request->all();
        //se encripta la contraseña
        $input['password']= Hash::make($request->password);
        User::create($input);
        return response()->json([
            'res'=>true,
            'message'=>'Usuario creado correctamente'
        ],200);
    }

    //login
    public function login (Request $request){
        //se obtiene el primer usuario
        $user= User::whereEmail($request->email)->first();
        //se comprueba si está nulo y si el hash en el password coinciden
        if(!is_null($user)&&Hash::check($request->password,$user->password)){
            //crear un token con laravel passport
            $token=$user->createToken('')->accessToken;
            return response()->json([
                'res'=>true,
                'token'=>$token,
                'message'=>'Bienvenido al sistema'
            ],200);
        }else{
            return response()->json([
                'res'=>false,
                'message'=>'Cuenta o password incorrectos'
            ],200);
        }
    }
    public function logout(){
        $user=auth()->user();
        //buscar cada token del usuario y elminar
        $user->tokens->each(function($token,$key){
            $token->delete();
        });
        $user->save();
        return response()->json([
            'res'=>true,
            'message'=>'Sesión Cerrada'
        ],200);
    }
}
