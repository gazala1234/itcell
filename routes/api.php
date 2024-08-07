<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Contact;
use App\Http\Controllers\AssignmentController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::middleware(['web'])->group(function () {
    // Routes handled by AuthController
    Route::controller(AuthController::class)->group(function () {
        Route::post('/register', 'register')->name('register');
        Route::get('/login', 'index')->name('login_form');
        Route::post('/login', 'login')->name('login');
        Route::get('/changePass', 'changePassword')->name('changePass');
        Route::post('/submitChangedPassword', 'submitPassword')->name('submitPass');
        Route::get('/forgotPass', 'forgotPass')->name('forgotPass');
        Route::post('/forgotPassword', 'forgotPassword')->name('forgotPassword');
        Route::get('/myProfile', 'profile_form')->name('myProfile');
    });

    // Routes handled by AssignmentController
    Route::controller(AssignmentController::class)->group(function () {
        Route::get('/Add_Assignment', 'index')->name('add_assignment');
        Route::get('/submitAssignment', 'submitAssign')->name('submitAssign');
        Route::get('/View_Assignment', 'viewAssignment')->name('view_assignment');
    });

    //Route handled by Contact - Controller
    Route::controller(Contact::class)->group(function () {
        Route::get('/Contact', 'index')->name('contact');
    });
    
    // Logout route (outside of groups)
    Route::get('/logout', function (Request $request) {
        $request->session()->forget(['id', 'name', 'cid', 'did']);
        $request->session()->flush();
        return redirect()->route('login');
    })->name('logout');
});