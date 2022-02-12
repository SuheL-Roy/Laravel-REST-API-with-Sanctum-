<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use PhpParser\Node\Stmt\Return_;

//use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request){
        $request->validate([
          'name' => 'required',
          'email' => 'required|email',
          'password' => 'required|confirmed',
        ]);

        $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('mytoken')->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token,
        ],201);
    }
    //Laravel\Sanctum\HasApiTokens
    public function logout(Request $request){
        Auth::user()->tokens->each(function($token, $key) {
            $token->delete();
        });
       // auth()->user()->tokens()->delete();
       return response(['message'=> 'success'], 200);
        //echo"wellcome";
       
    } 

    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
          ]);
          $user = User::where('email',$request->email)->first();
          if(!$user||!Hash::check($request->password,$user->password)){
            return response([
                'message' => 'The provided credentials are incorrect.'
           ], 401);
          } 
          $token = $user->createToken('mytoken')->plainTextToken;
          return response([
              'user' => $user,
              'token' => $token,
          ],201);

        }

    }