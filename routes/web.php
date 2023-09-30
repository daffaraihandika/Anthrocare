<?php

use App\Http\Controllers\daftarController;
use App\Http\Controllers\hasilPemeriksaanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\pemeriksaanController;
use Illuminate\Support\Facades\Route;
use App\Models\Infant;
use App\Models\Parents;

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
    $title = 'Home';
    $jumlah_data_infant = Infant::count();
    $jumlah_data_parent = Parents::count();

    return view('home', compact('title', 'jumlah_data_infant', 'jumlah_data_parent'));
})->middleware('auth');

// Daftar routes
Route::get('/daftar', [daftarController::class, 'index'])->middleware('auth'); //tambah middleware auth // tampilan tabel isinya data orangtua, di row nya ada aksi buat daftarin anak, di atas tabelnya ada tambah baru buat orangtua yang belum pernah terdaftar, bagusnya di atas tabelnya ada fitur search biar gausah nyari ortunya satu satu
Route::get('/daftar/add-parent', [daftarController::class, 'showAddParent'])->middleware('auth'); //tambah middleware auth // tampilan form buat ngisi biodata orangtua
Route::post('/daftar/add-parent', [DaftarController::class, 'addParent'])->name('daftar.add-parent'); // submit untuk mendaftarkan orangtua baru
Route::delete('/daftar/{infant:parent_id}', [daftarController::class, 'deleteParent']);
Route::get('/daftar/add-infant/{infant:parent_id}', [daftarController::class, 'showAddInfant'])->name('daftar.show-infant')->middleware('auth'); //tambah middleware auth // tampilan form buat mendaftarkan anak baru, nanti parent_id nya diisi sama id_parent
Route::post('/daftar/add-infant/{infant:parent_id}', [daftarController::class, 'addInfant'])->name('daftar.add-infant'); // submit untuk mendaftarkan anak baru

// Pemeriksaan routes
Route::get('/pemeriksaan', [pemeriksaanController::class, 'index'])->middleware('auth'); //tambah middleware auth // menampilkan list bayi yang udah terdaftar, ada fitur search buat cari bayi lebih cepat, pada setiap list bayi tersebut terdapat tombol aksi untuk mengarah ke /pemeriksaan/bayi/{id_bayi}
Route::delete('/pemeriksaan/{infant:id}', [pemeriksaanController::class, 'deleteInfant']);
Route::get('/pemeriksaan/periksaInfant/{infant:id}', [pemeriksaanController::class, 'getInfant'])->middleware('auth'); //tambah middleware auth // menampilkan tampilan pemeriksaan bayi, terdapat identitas bayi, tombol get data, input field bb,tb,suhu,z-score,btnSubmit, di pinggirnya ada informasi mengenai status kondisi bayi
Route::post('/pemeriksaan/periksaInfant/{infant:id}/sendData', [pemeriksaanController::class, 'sendData'])->name('pemeriksaan.sendData');
Route::get('/pemeriksaan/getData/{infant:id}', [pemeriksaanController::class, 'getData'])->name('pemeriksaan.getData')->middleware('auth'); //tambah middleware auth
Route::post('/pemeriksaan/periksaInfant/', [pemeriksaanController::class, 'createCheckupInfant'])->name('pemeriksaan.periksaInfant'); // untuk submit, dan memasukkan data ke tabel pemeriksaan

// Hasil Pemeriksaan routes
Route::get('/hasilPemeriksaan', [hasilPemeriksaanController::class, 'index'])->middleware('auth'); //tambah middleware auth
Route::get('/hasilPemeriksaan/detail/{infant:id}', [hasilPemeriksaanController::class, 'getInfant'])->middleware('auth'); //tambah middleware auth
Route::get('/hasilPemeriksaan/exportPDF/{infant:id}', [hasilPemeriksaanController::class, 'exportPDF'])->middleware('auth'); //tambah middleware auth

// Login routes
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest'); // tambah middleware guest
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

// pemeriksaan balita
// Route::post('/send-data/{id}/{nama_bayi}/{usia}/{jenis_kelamin}', [pemeriksaanController::class, 'sendData']);

// Route::post();


// Route::get('/daftars', [daftarController::class, 'getDaftar']);

// Route::post('/daftar', [daftarController::class, 'store']);

// Route::get('/hasil-pemeriksaan', function () {
//     return view('hasil-pemeriksaan', [
//         "title" => "Hasil-Pemeriksaan"
//     ]);
// });