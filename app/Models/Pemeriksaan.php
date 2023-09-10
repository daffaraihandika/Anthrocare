<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'pemeriksaan';

    public function infants(){
        return $this->belongsTo('App\Models\Pemeriksaan', 'id_infant', 'id');
    }
}
