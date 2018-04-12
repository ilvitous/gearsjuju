<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gearrequest extends Model
{
    //
    
    public function gearevent()
    {
        return $this->belongsTo('App\Gearevent');
    }
    

    public function users()
    {
        return $this->belongsTo('App\User');
    }
    
    
    public function equipments()
    {
        return $this->hasMany('App\Equipment');
    }
    
    
}
