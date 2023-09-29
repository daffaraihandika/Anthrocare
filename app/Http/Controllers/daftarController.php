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
        $message = [
            'nama_orangtua.required' => 'Nama wajib diisi',
            'tgl_lahir_orangtua.required' => 'Tanggal lahir wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'no_ktp.required' => 'No KTP wajib diisi',
            'no_ktp.unique' => 'No KTP sudah terdaftar',
            'gol_darah.required' => 'Golongan darah wajib diisi',
            'no_telp.required' => 'No telepon wajib diisi',
        ];

        $request->validate(
            [
                'nama_orangtua' => 'required',
                'tgl_lahir_orangtua' => 'required',
                'alamat' => 'required',
                'no_ktp' => 'required|unique:parents',
                'gol_darah' => 'required',
                'no_telp' => 'required'
            ],
            $message
        );

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
        $message = [
            'nama_bayi.required' => 'Nama wajib diisi',
            'tgl_lahir_bayi.required' => 'Tanggal lahir wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
            'no_akte_bayi.required' => 'No akte bayi wajib diisi',
            'no_akte_bayi.unique' => 'No akte bayi sudah terdaftar',
            'tinggi_lahir.required' => 'Tinggi lahir wajib diisi',
            'berat_lahir.required' => 'Berat lahir wajib diisi',
        ];

        $request->validate(
            [
                'nama_bayi' => 'required',
                'tgl_lahir_bayi' => 'required',
                'jenis_kelamin' => 'required',
                'no_akte_bayi' => 'required|unique:infants',
                'tinggi_lahir' => 'required',
                'berat_lahir' => 'required'
            ],
            $message
        );

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

    // function buat api 
    public function getOrtu(){
        $data_ortu = Parents::orderBy('id', 'desc')->paginate(10); // get data with pagination
        
        return $data_ortu;
    }

    public function getAddInfant($parent_id){
        $namaOrangTua = Parents::where("id", $parent_id)->pluck('id')->first(); // ngambil data nama orang tua
        return $namaOrangTua;
    }

}

class apiDaftarController extends Controller{
    public function getOrtu(){
        $data_ortu = Parents::orderBy('id', 'desc')->paginate(10); // get data with pagination
        
        $rensponse = [
            "status" => 1,
            "data" => $data_ortu
        ];
        
        return $rensponse;
    }
}