<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Films extends Model
{
    public function Comments(){
        return $this->hasMany(Comment::class,'FilmId','id');
    }
}
