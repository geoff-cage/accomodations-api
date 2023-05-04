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
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json('Please fill all fields',400);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user = User::where(); // please assist i wanna create a token but im not familiar when using a model directly
    }
}
