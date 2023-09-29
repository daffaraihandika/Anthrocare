<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infant;
use App\Models\Parents;
use Carbon\Carbon;

class apiDaftarController extends Controller{
    public function index(){
        $data_ortu = Parents::orderBy('id', 'desc')->paginate(10); // get data with pagination
        
        $rensponse = [
            "status" => 1,
            "data" => $data_ortu
        ];
        
        return $rensponse;
    }
}