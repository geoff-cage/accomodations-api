<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register( Request $request)
    {
        $validator = Validator::make($request->all(),[ 
            'name' => 'required',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json('Please fill all fields',400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

         $token = $user->createToken('Institutionalized')->plainTextToken;

         $response = [
            'user' => $user,
            'token' => $token
         ];

         return response($response, 201);
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        //check email
        $user = User::where('email', $request->email)->first();

        //check password
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json('The provided credentials are incorrect.', 400);
        }

        $token = $user->createToken('Institutionalized')->plainTextToken;

        $response = [
           'user' => $user,
           'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete(); 
        //$request->user()->tokens()->delete();  both methods work im just curious as why i get the red line on the top one 

        return[
            'message' => 'Logged out'
        ];
    }
}
