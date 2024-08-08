<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\validator;
use Illuminate\Support\Facades\Session;

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
                session([
                    'id' => $user->id,
                    'name' => $user->name,
                    'cid' => $user->cid,
                    'did' => $user->did
                ]);
                // dd($user);
                return response()->json(['message' => 'Logged in successfully', 'user' => $user], 201);
            } else {
                // Password is incorrect
                return response()->json(['error' => 'Incorrect password'], 422);
            }
        } else {
            // User not found with the provided email
            return response()->json(['error' => 'User not found with provided email or phone'], 422);
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
            'new_pass' => 'required',
            'new_confirm' => 'required|same:new_pass'
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 422);
        }

        $id = Session::get('id');
        $user = DB::table('admin')->where('id', $id)->first();
        // Query to check old password is correct or not

        if ($request->old_pass !== $user->pass) {
            return response()->json(['error' => 'Incorrect old password'], 400);
        }

        if ($request->old_pass === $request->new_pass) {
            return response()->json(['error' => 'Old and new password cannot be the same'], 400);
        }

        DB::table('admin')->where('id', $id)->update(['pass' => $request->new_pass]);

        return response()->json(['message' => 'Password changed successfully'], 200);
    }

    // FORGOT PASSWORD METHOD
    public function forgotPass()
    {
        return view('forgotPass');
    }

    public function forgotPassword(Request $request)
    {
        // Validate the incoming request
        $validatedData = Validator::make($request->all(), [
            'email' => 'required',
            'new_pass' => 'required',
            'new_confirm' => 'required|same:new_pass'
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 422);
        }

        $email = $request->email;

        $user = DB::table('admin')
            ->where('email', $email)
            ->first();
        if (!$user) {
            return response()->json(['error' => 'Incorrect email id'], 400);
        } else if ($user->pass == $request->new_pass) {
            return response()->json(['error' => 'New password is same as old password'], 400);
        }
        DB::table('admin')
            ->where('email', $email)
            ->update(['pass' => $request->new_pass]);
        return response()->json(['message' => 'Password set successfully'], 200);
    }
    public function profile_form()
    {
        $fid = Session::get('id');

        return view('myProfile');
    }
}
