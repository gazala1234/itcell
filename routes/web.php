<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//Starting Page route
Route::get('/',[AuthController::class, 'index'])->name('index');

//After login dashboard route is calling
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//Register form route direct from here
Route::get('/register', function () {
    return view('register');
})->name('registerForm');


Route::get('/contact', function () {
    return view('contact');
})->name('contactpage');



