<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\ProfileController;
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

Route::get('/mahasiswa', [MahasiswaController::class, 'index']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/buku/rating/{id}', [BukuController::class, 'rating'])->name('buku.rating');
    Route::post('/buku/favourite/{id}', [BukuController::class, 'storeFavourite'])->name('buku.favourite.store');
    Route::get('/buku/myfavourite', [BukuController::class, 'myFavourite'])->name('buku.favourite.index');
    Route::post('/buku/favourite/delete/{id}', [BukuController::class, 'deleteFavourite'])->name('buku.favourite.delete');


    Route::middleware('admin')->group(function() {
        Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
        Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');

        Route::post('/buku/delete/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

        Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
        Route::post('/buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');

        Route::post('buku/delete_galeri/{id}', [BukuController::class, 'deleteGaleri'])->name('buku.delete_galeri');
    });

});
Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');
Route::get('/detail_buku/{id}', [BukuController::class, 'galbuku'])->name('buku.galeri');


require __DIR__.'/auth.php';
