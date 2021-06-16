<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request){
        if (!Auth::attempt($request->all())){
            return response()->json(['res'=>'Usuario no encontrado'],400);
        }
        $user=User::where('email',$request->email)->firstOrfail();
        $token=$user->createToken('auth_token')->plainTextToken;
        return response()->json(['token'=>$token,'user'=>$user],200);
    }
    public function register(Request $request){

    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['res'=>'Usuario salio del sistema'],200);
    }
    public function me(Request $request){
        return $request->user();
    }
}
