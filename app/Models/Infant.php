<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infant extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function parents(){
        return $this->belongsTo(Parents::class, 'parent_id');
    }
}
