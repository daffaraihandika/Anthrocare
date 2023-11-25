<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\daftarController;
use App\Http\Controllers\hasilPemeriksaanController;
use App\Http\Controllers\pemeriksaanController;
use App\Models\Infant;
use App\Models\Parents;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// auth
Route::post('/login', [LoginController::class, 'apilogin']);
Route::post('/logout', [LoginController::class, 'apilogout']);

// Parent
Route::get('/daftar', [daftarController::class, 'getParent']); 
Route::post('/daftar/add-parent', [daftarController::class, 'createParent'])->name('daftar.add-parent');
Route::delete('/daftar/{infant:parent_id}', [daftarController::class, 'deleteParentapi']);

// Pemeriksaan (Infant)
Route::get('/pemeriksaan', [pemeriksaanController::class, 'getPemeriksaan']);
Route::delete('/pemeriksaan/{infant:id}', [pemeriksaanController::class, 'deleteInfantapi']);

// Hasil Pemeriksaan 
Route::get('/hasilPemeriksaan', [hasilPemeriksaanController::class, 'indexapi']);
Route::get('/hasilPemeriksaan/detail/{infant:id}', [hasilPemeriksaanController::class, 'getInfantapi']);