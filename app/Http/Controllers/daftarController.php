<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infant;
use App\Models\Parents;

class daftarController extends Controller
{
    //
    public function index(){
        return view('daftar', [
            "title" => "Daftar",
            "data_ortu" => Parents::all(), // ngambil data ortu
        ]);
    }

    public function addParent(){
        return view('add-parent', [
            "title" => "Add Parent",
        ]);
    }

    public function addInfant($parent_id){
        return view("add-infant", [
            "title" => "Add Infant",
            "infant" => Infant::firstWhere("parent_id", $parent_id) // ngambil data bayi
        ]);
    }

    public function getDaftar(){
        $infants = Infant::all();
        $parents = Parents::all();

        $data = [
            'infants' => $infants,
            'parents' => $parents,
        ];

        return response()->json($data);
    }

    public function store(Request $request){
        // Orang tua
        $validateParent = $request->validate([
            'nama_orangtua' => 'required|max:255',
            'tgl_lahir_orangtua' => 'required',
            'alamat' => 'required',
            'no_ktp' => ['required', 'unique:parents', 'max:255'],
            'gol_darah' => 'required|in:A,B,AB,O',
            'no_telp' => ['required', 'max:255'],
        ]);

        $existingParent = Parents::where('no_ktp', $request->input('no_ktp'))->first();
        // dd($existingParent);

        if ($existingParent) {
            // Orang tua sudah ada, isi ulang data yang ada
            $existingParent->fill($validateParent);
            // dd($existingParent);
            $existingParent->save();
        } else {
            // Orang tua belum ada, buat rekaman baru
            $parent = new Parents($validateParent);
            $parent->save();
        }

        // Bayi
        $validateInfant = $request->validate([
            'nama_bayi' => 'required|max:255',
            'tgl_lahir_bayi' => 'required',
            'jenis_kelamin' => 'required|in:Laki - Laki,Perempuan',
            'no_akte_bayi' => ['required', 'unique:infants', 'max:255'],
            'tinggi_lahir' => 'required',
            'berat_lahir' => ['required'],
        ]);

        $infant = new Infant([
            'nama_bayi' => $request->input('nama_bayi'),
            'tgl_lahir_bayi' => $request->input('tgl_lahir_bayi'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'no_akte_bayi' => $request->input('no_akte_bayi'),
            'tinggi_lahir' => $request->input('tinggi_lahir'),
            'berat_lahir' => $request->input('berat_lahir'),
        ]);

        
        $result = $parent->infant()->save($infant);

        // Parents::create($validateParent);
        // return response()->json([
        //     'message' => 'berhasil',
        //     'data' => $result

        // ]);
        return redirect('/')->with("success", "Berhasil daftar");

    }

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
