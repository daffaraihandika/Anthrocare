<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temporary extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $table = 'tempo';

    public function infants(){
        return $this->belongsTo('App\Models\Temporary', 'id_infant', 'id');
    }
}
