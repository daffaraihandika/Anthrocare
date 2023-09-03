<?php

use App\Http\Controllers\daftarController;
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
    return view('home', [
        "title" => "Home",
    ]);
});

Route::get('/daftar', [daftarController::class, 'index']);
Route::get('/daftars', [daftarController::class, 'getDaftar']);

Route::post('/daftar', [daftarController::class, 'store']);

Route::get('/pemeriksaan', function () {
    return view('pemeriksaan', [
        "title" => "Pemeriksaan",
    ]);
});

Route::get('/hasil-pemeriksaan', function () {
    return view('hasil-pemeriksaan', [
        "title" => "Hasil-Pemeriksaan"
    ]);
});
