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

Route::get('/daftar', [daftarController::class, 'index']); // tampilan tabel isinya data orangtua, di row nya ada aksi buat daftarin anak, di atas tabelnya ada tambah baru buat orangtua yang belum pernah terdaftar, bagusnya di atas tabelnya ada fitur search biar gausah nyari ortunya satu satu
Route::get('/daftar/add-parent', [daftarController::class, 'showAddParent']); // tampilan form buat ngisi biodata orangtua
Route::post('/daftar/add-parent', [DaftarController::class, 'addParent'])->name('daftar.add-parent'); // submit untuk mendaftarkan orangtua baru
Route::get('/daftar/add-infant/{infant:parent_id}', [daftarController::class, 'showAddInfant'])->name('daftar.show-infant'); // tampilan form buat mendaftarkan anak baru, nanti parent_id nya diisi sama id_parent
Route::post('/daftar/add-infant/{infant:parent_id}', [daftarController::class, 'addInfant'])->name('daftar.add-infant'); // submit untuk mendaftarkan anak baru


// Route::get('/daftars', [daftarController::class, 'getDaftar']);

// Route::post('/daftar', [daftarController::class, 'store']);

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
