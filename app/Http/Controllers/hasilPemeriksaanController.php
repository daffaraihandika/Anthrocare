<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infant;
use App\Models\Parents;
use App\Models\Pemeriksaan;
use Carbon\Carbon;

class hasilPemeriksaanController extends Controller
{
    public function index(){
        $title = 'Hasil Pemeriksaan';
        $data_bayi = Infant::with('parents')->get();
        return view('hasil pemeriksaan/indexHasilPemeriksaan', compact('title', 'data_bayi'));
    }

    public function getInfant($id){
        $title = "Pemeriksaan";
        $identitas_bayi = Infant::join('parents', 'infants.id_parent', '=', 'parents.id')
        ->where('infants.id', $id)
        ->select('infants.id' ,'infants.nama_bayi', 'infants.jenis_kelamin', 'infants.tgl_lahir_bayi', 'infants.no_akte_bayi', 'parents.nama_orangtua', 'parents.alamat')
        ->get();

        $identitas_bayi->map(function ($bayi) {
            $bayi->usia = $this->calculateAgeInMonths($bayi->tgl_lahir_bayi);
            return $bayi;
        });

        $all_inspection = Pemeriksaan::join('infants', 'pemeriksaan.id_infant', '=', 'infants.id')
        ->where('pemeriksaan.id_infant', $id)
        ->select('pemeriksaan.tgl_pemeriksaan', 'pemeriksaan.suhu', 'pemeriksaan.berat', 'pemeriksaan.panjang_badan', 'pemeriksaan.zscore', 'pemeriksaan.kondisi')
        ->get();

        $last_inspection = Pemeriksaan::join('infants', 'pemeriksaan.id_infant', '=', 'infants.id')
        ->where('pemeriksaan.id_infant', $id)
        ->select('pemeriksaan.tgl_pemeriksaan', 'pemeriksaan.suhu', 'pemeriksaan.berat', 'pemeriksaan.panjang_badan', 'pemeriksaan.zscore', 'pemeriksaan.kondisi')
        ->orderBy('pemeriksaan.tgl_pemeriksaan', 'desc')
        ->first();


        // return $all_inspection;
        return view('hasil pemeriksaan/detail', compact('title', 'identitas_bayi', 'last_inspection', 'all_inspection'));
    }

    public function calculateAgeInMonths($birthdate) {
        $birthdate = Carbon::parse($birthdate);
        $currentDate = Carbon::now();
    
        $ageInMonths = $currentDate->diffInMonths($birthdate);
    
        return $ageInMonths;
    }
}