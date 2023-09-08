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


        // Input to Database
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
        // return 'halaman add infant dari parent id = ' .$parent_id;
    }

    public function addInfant(Request $request){
        // Validate data anak sesuai dengan kebutuhan Anda
        // $dataAnak = [
        //     'parent_id' => $parent_id, // Mengisi parent_id berdasarkan parameter yang diberikan
        //     'nama_anak' => $request->nama_anak, // Misalnya, nama anak diambil dari input nama_anak
        //     // tambahkan kolom-kolom lain sesuai dengan kebutuhan
        // ];
    
        // $id_parent = Parents::where("id", $parent_id)->pluck('id');

        // Simpan data anak ke dalam database
        // Infant::create($dataAnak);
    
        // Redirect ke halaman yang sesuai atau berikan respons sesuai kebutuhan Anda
        // return redirect()->route('daftar.index')->with("success", "Berhasil Menambahkan Data Anak");        
    
        $data = $request->all();

        Infant::create($data);

        // return [
        //     "status" => 1,
        //     "data" => $data,
        //     "msg" => "Data Kategori Donasi created successfully"
        // ];    

        return redirect()->to('daftar')->with("succes", "Berhasil Menambahkan Data Orang Tua");
        // return 'post add infant dari parent id = ' .$parent_id;
    }    

    // public function getDaftar(){
    //     $infants = Infant::all();
    //     $parents = Parents::all();

    //     $data = [
    //         'infants' => $infants,
    //         'parents' => $parents,
    //     ];

    //     return response()->json($data);
    // }

    // public function store(Request $request){
    //     // Orang tua
    //     $validateParent = $request->validate([
    //         'nama_orangtua' => 'required|max:255',
    //         'tgl_lahir_orangtua' => 'required',
    //         'alamat' => 'required',
    //         'no_ktp' => ['required', 'unique:parents', 'max:255'],
    //         'gol_darah' => 'required|in:A,B,AB,O',
    //         'no_telp' => ['required', 'max:255'],
    //     ]);

    //     $existingParent = Parents::where('no_ktp', $request->input('no_ktp'))->first();
    //     // dd($existingParent);

    //     if ($existingParent) {
    //         // Orang tua sudah ada, isi ulang data yang ada
    //         $existingParent->fill($validateParent);
    //         // dd($existingParent);
    //         $existingParent->save();
    //     } else {
    //         // Orang tua belum ada, buat rekaman baru
    //         $parent = new Parents($validateParent);
    //         $parent->save();
    //     }

    //     // Bayi
    //     $validateInfant = $request->validate([
    //         'nama_bayi' => 'required|max:255',
    //         'tgl_lahir_bayi' => 'required',
    //         'jenis_kelamin' => 'required|in:Laki - Laki,Perempuan',
    //         'no_akte_bayi' => ['required', 'unique:infants', 'max:255'],
    //         'tinggi_lahir' => 'required',
    //         'berat_lahir' => ['required'],
    //     ]);

    //     $infant = new Infant([
    //         'nama_bayi' => $request->input('nama_bayi'),
    //         'tgl_lahir_bayi' => $request->input('tgl_lahir_bayi'),
    //         'jenis_kelamin' => $request->input('jenis_kelamin'),
    //         'no_akte_bayi' => $request->input('no_akte_bayi'),
    //         'tinggi_lahir' => $request->input('tinggi_lahir'),
    //         'berat_lahir' => $request->input('berat_lahir'),
    //     ]);

        
    //     $result = $parent->infant()->save($infant);

    //     // Parents::create($validateParent);
    //     // return response()->json([
    //     //     'message' => 'berhasil',
    //     //     'data' => $result

    //     // ]);
    //     return redirect('/')->with("success", "Berhasil daftar");

    // }

    // public function store(Request $request){
    //     // Orang tua
    //     $validateParent = $request->validate([
    //         'nama_orangtua' => 'required|max:255',
    //         'tgl_lahir_orangtua' => 'required',
    //         'alamat' => 'required',
    //         'no_ktp' => ['required', 'unique:parents', 'max:255'],
    //         'gol_darah' => 'required|in:A,B,AB,O',
    //         'no_telp' => ['required', 'max:255'],
    //     ]);
    
    //     $existingParent = Parents::where('no_ktp', $request->input('no_ktp'))->first();
    
    //     if ($existingParent) {
    //         // Orang tua sudah ada, isi ulang data yang ada
    //         $existingParent->fill($validateParent);
    //         $existingParent->save();
    //     } else {
    //         // Orang tua belum ada, buat rekaman baru
    //         $parent = new Parents($validateParent);
    //         $parent->save();
    //     }
    
    //     // Bayi
    //     $validateInfant = $request->validate([
    //         'nama_bayi' => 'required|max:255',
    //         'tgl_lahir_bayi' => 'required',
    //         'jenis_kelamin' => 'required|in:Laki - Laki,Perempuan',
    //         'no_akte_bayi' => ['required', 'unique:infants', 'max:255'],
    //         'tinggi_lahir' => 'required',
    //         'berat_lahir' => ['required'],
    //     ]);
    
    //     $infant = new Infant([
    //         'nama_bayi' => $request->input('nama_bayi'),
    //         'tgl_lahir_bayi' => $request->input('tgl_lahir_bayi'),
    //         'jenis_kelamin' => $request->input('jenis_kelamin'),
    //         'no_akte_bayi' => $request->input('no_akte_bayi'),
    //         'tinggi_lahir' => $request->input('tinggi_lahir'),
    //         'berat_lahir' => $request->input('berat_lahir'),
    //     ]);
    
    //     $result = $parent->infant()->save($infant);
    
    //     return response()->json([
    //         'message' => 'Data berhasil disimpan',
    //         'data' => $result,
    //     ]);
    // }
    
}
