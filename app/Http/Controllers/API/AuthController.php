<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signup(Request $request) {
        $validator =  Validator::make($request->all(), [
            'name'=> 'required',
            'email'=>'required|email|unique:users,email',
            'password'=> 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status'=>false,
                'message'=>'Validation Error',
                'errors'=>$validator->errors()->all()
            ], 401);
        }
        $user = User::create(['name'=>$request->name, 'email'=>$request->email, 'password'=>$request->password]);
        return response()->json([
                'status'=>true,
                'message'=>'Validation Error',
                'user'=>$user
            ], 201);
    }

     public function login(Request $request) {
        $validator =  Validator::make($request->all(), [
            'email'=>'required|email',
            'password'=> 'required'
        ]);
         if($validator->fails()) {
            return response()->json([
                'status'=>false,
                'message'=>'Invalid Authentication failed',
                'errors'=>$validator->errors()->all()
            ], 401);
        }
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])) {
            $authUser = Auth::user();
            return response()->json([
                'status'=>true,
                'message'=>'Authentication failed',
                'token'=>$authUser->createToken('API Token')->plainTextToken,
                'token_type'=>'bearer'
            ], 200);
        } else {
            return response()->json([
                'status'=>false,
                'message'=>'Authentication failed',
            ], 401);
        }

        //return response()->json(['message'=>"Hello World"]);
    }

     public function logout(Request $request) {
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json([
                'status'=>true,
                'message'=>'Successfully logged out',
            ], 200);
    }
}
