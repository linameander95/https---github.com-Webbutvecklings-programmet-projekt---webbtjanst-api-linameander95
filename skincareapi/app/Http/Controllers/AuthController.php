<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register user
    public function register(Request $request) {
        $validatedUser = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]
        );

        //Failed registration
        if($validatedUser->fails()) {
            return response ()->json([
                'message' => 'Failed to register user. Check that all fields have been filled in correctly.',
                'error' => $validatedUser->errors()
            ], 401);
        }

        //Succesful registration, store user details and return token
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);

        $token = $user->createToken('APITOKEN')->plainTextToken;

        $response = [
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    //Login user
    public function login(Request $request) {
        $validatedUser = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        //Failed registration
        if($validatedUser->fails()) {
            return response ()->json([
                'message' => 'Validation error.',
                'error' => $validatedUser->errors()
            ], 401);
        }

        //Failed login
        if(!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Incorrect user credentials'
            ], 401);
        }

        //Successfull login
        $user = User::where('email', $request->email)->first();

        return response()->json([
            'message' => 'Login successfull',
            'token' => $user->createToken('APITOKEN')->plainTextToken,
            'name' => $user
        ], 200);
    }

    //Logout

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        $response= [
            'message' => 'Logged out'
        ];
        return response($response, 200);
    }
}
