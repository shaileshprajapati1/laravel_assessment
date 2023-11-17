<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::view('/', 'register_login');
Route::view('/home', 'homepage')->middleware('auth.session');

Route::view('/admindashboard', 'admin.admindashboard')->middleware('auth.session');
Route::view('/viewall', 'admin.viewallproducts')->middleware('auth.session');
Route::post("logout", [\App\Http\Controllers\auth\AuthController::class, 'logout']);
