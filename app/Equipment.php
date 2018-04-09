<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    //
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    
    public function get_category_quanity($category_id){
        
        $counts = Equipment::where('category_id', $category_id)->get();
        return count($counts);
            
    }
    
    
}
