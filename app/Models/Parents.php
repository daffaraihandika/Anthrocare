<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function infant(){
        return $this->hasMany(Infant::class, 'parent_id');
    }
}
