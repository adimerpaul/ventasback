<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request){
        if (!Auth::attempt($request->all())){
            return response()->json(['res'=>'Usuario no encontrado'],400);
        }
        $user=User::where('email',$request->email)->firstOrfail();
        $token=$user->createToken('auth_token')->plainTextToken;
        $user2=User::where('id',$user->id)->with('usuariopermisos')->get();
        return response()->json(['token'=>$token,'user'=>$user2],200);
    }

    public function listuser(){
        return User::select('id','name','email')->with('usuariopermisos')->get();
    }

    public function register(Request $request){
        $user=User::create(['name'=>$request->name,'email'=>$request->email,'password'=>Hash::make($request->password),'empresa_id'=>1]);
        foreach ($request->group as $row) {
            DB::table('usuariopermisos')->insert(['user_id'=>$user->id,'permiso_id'=>$row]);
        }
        return $user; 
    }

    public function modificar(Request $request){
        $user=User::find($request->id);
        $user->update(['name'=>$request->name]);
        return $user;
    }

    public function modpass(Request $request){
        $user=User::find($request->id);
        $user->update(['password'=>Hash::make($request->password)]);
        return $user;
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['res'=>'Usuario salio del sistema'],200);
    }
    public function me(Request $request){
//        return $request->user();
        return User::where('id',$request->user()->id)->with('usuariopermisos')->get();
    }
}
