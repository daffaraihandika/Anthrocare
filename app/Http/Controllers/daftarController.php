<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infant;
use App\Models\Parents;

class daftarController extends Controller
{
    //
    public function index(){
        return view('daftar/index', [
            "title" => "Daftar",
            "data_ortu" => Parents::orderBy('id', 'asc')->get(), // mengambil semua data ortu
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

        Infant::create($data);

        // return ke json

        // return [
        //     "status" => 1,
        //     "data" => $data,
        //     "msg" => "Data Kategori Donasi created successfully"
        // ];    

        return redirect()->to('daftar')->with("succes", "Berhasil Menambahkan Data Orang Tua");
    }    
}
