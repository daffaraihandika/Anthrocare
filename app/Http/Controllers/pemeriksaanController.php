<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infant;
use App\Models\Parents;
use App\Models\Pemeriksaan;
use App\Models\Temporary;
use Carbon\Carbon;

class pemeriksaanController extends Controller
{
    public function index(){
        $title = 'Pemeriksaan';
        $data_bayi = Infant::with('parents')->orderBy('id', 'desc')->paginate(10); // get data with pagination
    
        return view('pemeriksaan/indexPemeriksaan', compact('title', 'data_bayi'));
    }

    public function getInfant($id){
        $title = "Pemeriksaan";
        $identitas_bayi = Infant::join('parents', 'infants.id_parent', '=', 'parents.id')
        ->where('infants.id', $id)
        ->select('infants.id' ,'infants.nama_bayi', 'infants.jenis_kelamin', 'infants.tgl_lahir_bayi', 'infants.no_akte_bayi', 'infants.usia', 'parents.nama_orangtua')
        ->get();

        // $identitas_bayi->map(function ($bayi) {
        //     $bayi->usia = $this->calculateAgeInMonths($bayi->tgl_lahir_bayi);
        //     return $bayi;
        // });

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

    public function sendData(Request $request) {
    
        // Simpan data ke tabel temporaries
        $temp = Temporary::create([
            'id_infant' => $request->id_infant,
            'nama_bayi' => $request->nama_bayi,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);
    
        // Redirect atau lakukan operasi lain yang diperlukan
        return redirect()->back()->with('success', 'Data berhasil dikirim ke alat Anthrocare');
        // return $temp;
    }

    public function getData($id) {
        $title = "Pemeriksaan";
        $identitas_bayi = Infant::join('parents', 'infants.id_parent', '=', 'parents.id')
        ->where('infants.id', $id)
        ->select('infants.id' ,'infants.nama_bayi', 'infants.jenis_kelamin', 'infants.tgl_lahir_bayi', 'infants.no_akte_bayi', 'infants.usia', 'parents.nama_orangtua')
        ->get();
    
        $result = Temporary::select(
                'temporaries.suhu',
                'temporaries.berat',
                'temporaries.panjang_badan',
                'temporaries.zscore',
            )
            ->orderBy('temporaries.created_at', 'desc')
            ->first();
    
        // return $result;
        // return $result;
        return view('pemeriksaan/getData', compact('title', 'identitas_bayi', 'result'));
    }    
    

    // method untuk tombol send

    // method untuk tombol submit
    public function createCheckupInfant(Request $request){
        // disiniii
            $data = $request->all();
            $data['tgl_pemeriksaan'] = now();

            if($data['zscore'] > 2){
                $data['kondisi'] = 'tinggi';
            }else if($data['zscore'] <= 2 && $data['zscore'] >= -2){
                $data['kondisi'] = 'normal';
            }else if($data['zscore'] < -2 && $data['zscore'] >= -3){
                $data['kondisi'] = 'stunted';
            }else if($data['zscore'] < -3){
                $data['kondisi'] = 'severely stunted';
            }

            // return $data;
            Pemeriksaan::create($data);
            // // return $data;
            return redirect()->to('hasilPemeriksaan/detail/'.$data['id_infant'])->with("success", "Berhasil Menambahkan Data Orang Tua");
            // return $data;
    }

    public function deleteInfant($id){
        Infant::where('id', $id)->delete();
        return back()->with("success", "Berhasil Menghapus Data Bayi");
    }
    
}