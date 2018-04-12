<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Group;

class Category extends Model
{
    //
    public function equipments()
    {
        return $this->hasMany('App\Equipment');
    }
    
    public function groups()
    {
        return $this->hasMany('App\Group');
    }
    
    public function get_category_group($category_id){
        $groups = Group::where('category_id', $category_id)->get();
        return $groups;
    }
    
    
}
