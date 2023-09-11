<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infant extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function parents(){
        return $this->belongsTo('App\Models\Parents', 'id_parent', 'id');
    }

    public function pemeriksaan(){
        return $this->hasMany('App\Models\Pemeriksaan');
    }

    public function temporary(){
        return $this->hasMany('App\Models\Temporary');
    }
}
