<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infant;
use App\Models\Parents;

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
        return view('pemeriksaan/index', compact('title', 'data_bayi'));
    }


}
