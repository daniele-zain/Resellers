<?php

  namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
class AuthController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function register(Request $request){
        $data=$request->all();
        $validator= Validator::make($data,[
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|unique:users,email',//unique to the users table and the email field
            'password' => 'required|string|confirmed',
            'address'=>'required|string',
            'phone'=>'string|required'
        ]);
        if($validator->fails()){
            return response()->json('Something went wrong!try again',400);
        }
       $user = Auth::user();

        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'address'=>$data['address'],
            //updated code
            'phone'=>$data['phone']
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $re = [
            'user' => $user,
            'token' => $token
        ];
        return response()->json($re,201);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        //check email
        $user = user::where('email' , $fields['email'])->first();

        //check password
        if(!$user || !Hash::check($fields['password'] , $user->password)){
            return response([
                'message' => 'bad creds'
            ] , 401);

        }
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
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




