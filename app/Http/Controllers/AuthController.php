<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function register(Request $request)
    {
        // Validate the incoming request
        $validatedData = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 422);
        }
        // Get the validated data
        $validatedData = $validatedData->validated();

        $user = DB::table('users')->insert([
            'email' => $validatedData['email'],
            'password' => $validatedData['password']
        ]);
        if ($user) {
            return response()->json(['message' => 'Registered successfully'], 201);
        } else {
            return response()->json(['error' => 'User creation failed', 'exception'], 500);
        }
    }


    public function login(Request $request)
    {
        // Validate the incoming request
        $validatedData = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 422);
        }
        $data = $validatedData->validated();
        // Attempt to find the user by email
        $user = DB::table('admin')
            ->where('email', $data['email'])
            ->orWhere('mobile', $data['email'])
            ->first();

        if ($user) {
            // User found, now check password
            if ($data['password'] === $user->pass) {
                session(['id' => $user->id, 'name' => $user->name, 'cid' => $user->cid, 'did' => $user->did]);
                // dd($user);
                return response()->json(['message' => 'Logged in successfully', 'user' => $user], 201);
            } else {
                // Password is incorrect
                return response()->json(['error' => 'Incorrect password'], 422);
            }
        } else {
            // User not found with the provided email
            return response()->json(['error' => 'User not found with provided email'], 422);
        }
    }


    // CHANGE PASSWORD METHOD
    public function changePassword()
    {
        return view('changePassword');
    }

    public function submitPassword(Request $request)
    {
        // Validate the incoming request
        $validatedData = Validator::make($request->all(), [
            'old_pass' => 'required',
            'new_pass' => 'required|confirmed',
            'new_confirm' => 'required'
        ]);

        // VALIDATION FAILS
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 422);
        }
        $data = $validatedData->validated();

        // Query to check old password is correct or not


    }
}
