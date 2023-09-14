<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infant;
use App\Models\Parents;
use App\Models\Pemeriksaan;
use Carbon\Carbon;
// use Barryvdh\DomPDF\Facade\Pdf;
use PDF;

class hasilPemeriksaanController extends Controller
{
    public function index(){
        $title = 'Hasil Pemeriksaan';
        $data_bayi = Pemeriksaan::join('infants', 'pemeriksaan.id_infant', '=', 'infants.id')
    ->join('parents', 'infants.id_parent', '=', 'parents.id')
    ->select(
        'pemeriksaan.id_infant',
        'infants.nama_bayi',
        'infants.no_akte_bayi',
        'infants.tgl_lahir_bayi',
        'infants.jenis_kelamin',
        'parents.nama_orangtua',
        'parents.no_ktp',
    )
    ->distinct("pemeriksaan.id_infant")
    ->groupBy('infants.nama_bayi')
    ->paginate(10);

        return view('hasil pemeriksaan/indexHasilPemeriksaan', compact('title', 'data_bayi'));
    }

    public function getInfant($id){
        $title = "Pemeriksaan";
        $identitas_bayi = Infant::join('parents', 'infants.id_parent', '=', 'parents.id')
        ->where('infants.id', $id)
        ->select(
            'infants.id',
            'infants.nama_bayi', 
            'infants.jenis_kelamin', 
            'infants.tgl_lahir_bayi', 
            'infants.no_akte_bayi', 
            'parents.nama_orangtua', 
            'parents.alamat'
        )
        ->get();

        $identitas_bayi->map(function ($bayi) {
            $bayi->usia = $this->calculateAgeInMonths($bayi->tgl_lahir_bayi);
            return $bayi;
        });

        $all_inspection = Pemeriksaan::join('infants', 'pemeriksaan.id_infant', '=', 'infants.id')
        ->where('pemeriksaan.id_infant', $id)
        ->select(
            'pemeriksaan.tgl_pemeriksaan', 
            'pemeriksaan.suhu', 
            'pemeriksaan.berat', 
            'pemeriksaan.panjang_badan', 
            'pemeriksaan.zscore', 
            'pemeriksaan.kondisi'
        )
        ->get();

        $last_inspection = Pemeriksaan::join('infants', 'pemeriksaan.id_infant', '=', 'infants.id')
        ->where('pemeriksaan.id_infant', $id)
        ->select(
            'pemeriksaan.tgl_pemeriksaan', 
            'pemeriksaan.suhu', 
            'pemeriksaan.berat', 
            'pemeriksaan.panjang_badan', 
            'pemeriksaan.zscore', 
            'pemeriksaan.kondisi',
            'pemeriksaan.created_at'
        )
        ->orderBy('pemeriksaan.created_at', 'desc')
        ->first();


        // return $last_inspection;
        return view('hasil pemeriksaan/detail', compact('title', 'identitas_bayi', 'last_inspection', 'all_inspection'));
    }

    public function calculateAgeInMonths($birthdate) {
        $birthdate = Carbon::parse($birthdate);
        $currentDate = Carbon::now();
    
        $ageInMonths = $currentDate->diffInMonths($birthdate);
    
        return $ageInMonths;
    }

    public function exportPDF(){
        // $pdf = Pdf::loadView('pdf.invoice');
        // $pdf = PDF::loadView('home', ['title' => 'Home']);
        // return $pdf->stream();
        // return $pdf->download('invoice.pdf');
        return "tes";
    }
}