<?php

namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request){
        ///validar datos
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        
        /// alta del usuario
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            "message" => "metodo registrar ok ",
            "status" => Response::HTTP_CREATED
        ]);

    }

    public function login(Request $request){
       $credentials =  $request->validate([
            'email' => ['required' , 'email'],
            'password' => ['required']
        ]);

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            $cookie = cookie('cookie_token', $token, 60 * 24);
            return response(["token" => $token] , Response::HTTP_OK)->withCookie($cookie);
        }else{
            return response(["message" => "credenciales invalidas"] , Response::HTTP_UNAUTHORIZED);
        }

    }

    public function userProfile(){
        return response()->json([
            "message" => "metodo perfil ok  ",
            "userData" => auth()->user()
        ],Response::HTTP_OK);
    }

    public function logout() {
        auth()->user()->tokens()->delete();
        $cookie = Cookie::forget('cookie_token');
        return response(['message'=> "cierre de sesion ok $cookie"], Response::HTTP_OK)->withCookie($cookie);
    }
}
