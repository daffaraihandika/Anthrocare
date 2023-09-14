<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infant;
use App\Models\Parents;
use Carbon\Carbon;

class daftarController extends Controller
{
    //
    public function index(){
        $data_ortu = Parents::orderBy('id', 'desc')->paginate(10); // get data with pagination
    
        return view('daftar/indexDaftar', [
            "title" => "Daftar",
            "data_ortu" => $data_ortu,
        ]);
    }

    public function showAddParent(){
        return view('daftar/addParent',[
            "title" => "Add Parent",
        ]);
    }

    public function addParent(Request $request){
        // Validate


        // insert to Database
        $data = [
            'nama_orangtua' => $request->nama_orangtua,
            'tgl_lahir_orangtua' => $request->tgl_lahir_orangtua,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'gol_darah' => $request->gol_darah,
            'no_telp' => $request->no_telp
        ];

        Parents::Create($data);

        return redirect()->to('daftar')->with("succes", "Berhasil Menambahkan Data Orang Tua");
    }

    public function showAddInfant($parent_id){
        $namaOrangTua = Parents::where("id", $parent_id)->pluck('id')->first(); // ngambil data nama orang tua
        $title = "Add Infant";
        return view("daftar/addInfant", compact('title', 'namaOrangTua'));
    }

    public function addInfant(Request $request){
        // Validate

        // insert ke database
        $data = $request->all();

        $usia = $this->calculateAgeInMonths($data['tgl_lahir_bayi']);

        $data['usia'] = $usia;

        $infant = Infant::create($data);

        $infantId = $infant->id;
        return redirect()->to('pemeriksaan/periksaInfant/'.$infantId)->with("succes", "Berhasil Menambahkan Data Bayi");
    }
    
    public function calculateAgeInMonths($birthdate) {
        $birthdate = Carbon::parse($birthdate);
        $currentDate = Carbon::now();
    
        $ageInMonths = $currentDate->diffInMonths($birthdate);
    
        return $ageInMonths;
    }

    public function deleteParent($parent_id){
        // return "tess ".$parent_id;
        Parents::where('id', $parent_id)->delete();
        return back()->with("success", "Berhasil Menghapus Data Orangtua");
    }
}