<?php

use App\Http\Controllers\BelajarController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tentang', function () {
    return view('about', [
        "name" => "Farhan Hanif",
        "email" => "farhanhanif@mail.ugm.ac.id"
    ]);
});

Route::get('/belajar', [BelajarController::class, 'coba']);
