<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gearevent extends Model
{
    //
    
     public function equipments()
    {
        return $this->hasMany('App\Equipment');
    }
}
