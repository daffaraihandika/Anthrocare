<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infant;
use App\Models\Parents;
use App\Models\Pemeriksaan;
use Carbon\Carbon;
use PDF;
// use Barryvdh\DomPDF\Facade\Pdf;
//
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
        ->get();

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

    public function exportPDF($id){
        // $pdf = Pdf::loadView('pdf.invoice');
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

        $pdf = PDF::loadView('pdf.detail', [
            'identitas_bayi' => $identitas_bayi,
            'last_inspection' => $last_inspection,
            'all_inspection' => $all_inspection,
        ]);
        $pdf->setPaper('a5', 'portrait');
        // return $pdf->stream();
        // Mendapatkan nama bayi
        $nama_bayi = $identitas_bayi->first()->nama_bayi; // Mengambil nama bayi dari data pertama dalam koleksi

        // Custom nama file download
        $nama_file = $nama_bayi . '_hasil-pemeriksaan.pdf';

        return $pdf->download($nama_file);
        // return "tes";
    }
}