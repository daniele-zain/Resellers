<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{

    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        //check email
        $admin = Admin::where('email' , $fields['email'])->first();

        //check password
        if(!$admin || !Hash::check($fields['password'] , $admin->password)){
            return response([
                'message' => 'bad creds'
            ] , 401);

        }
        $token = $admin->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $admin,
            'token' => $token
        ];

        return response($response , 201);
    }

    public function logout(Request $request){

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged Out'
        ],200);
    }
}
