<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infant;
use App\Models\Parents;
use Carbon\Carbon;

class pemeriksaanController extends Controller
{
    public function index(){
        $title = 'Pemeriksaan';
        $data_bayi = Infant::with('parents')->get();

        // return [
        //     "status" => 1,
        //     "data" => $data_bayi,
        //     "msg" => "berhasillll"
        // ];
        return view('pemeriksaan/indexPemeriksaan', compact('title', 'data_bayi'));
    }

    public function getInfant($id){
        $title = "Pemeriksaan";
        $identitas_bayi = Infant::join('parents', 'infants.id_parent', '=', 'parents.id')
        ->where('infants.id', $id)
        ->select('infants.id' ,'infants.nama_bayi', 'infants.jenis_kelamin', 'infants.tgl_lahir_bayi', 'infants.no_akte_bayi', 'parents.nama_orangtua')
        ->get();

        $identitas_bayi->map(function ($bayi) {
            $bayi->usia = $this->calculateAgeInMonths($bayi->tgl_lahir_bayi);
            return $bayi;
        });

        // return $identitas_bayi;
        return view('pemeriksaan/periksaInfant', compact('title', 'identitas_bayi'));
    }

    public function calculateAgeInMonths($birthdate) {
        $birthdate = Carbon::parse($birthdate);
        $currentDate = Carbon::now();
    
        $ageInMonths = $currentDate->diffInMonths($birthdate);
    
        return $ageInMonths;
    }

    // method untuk tombol get

    // method untuk tombol send

    // method untuk tombol submit
    public function createCheckupInfant(Request $request){
        
    }
    
}