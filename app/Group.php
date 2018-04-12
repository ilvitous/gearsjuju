<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    //
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    public function equipments()
    {
        return $this->hasMany('App\Equipment');
    }
}
