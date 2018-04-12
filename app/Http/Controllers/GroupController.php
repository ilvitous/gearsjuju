<?php

namespace App\Http\Controllers;


use App\Category;
use App\Group;


use Illuminate\Http\Request;
use App\Http\Requests\AddNewGroupRequest;
use App\Http\Requests\EditGroupRequest;
use App\Http\Requests\AllGroupRequest;

class GroupController extends Controller
{
    //
    
    
    public function add_new_group(AddNewGroupRequest $request){
        
        $group = new Group;
        $group->name = $request->name;
        $category = Category::find($request->category);
        $group->category()->associate($category);
        $group->save();
        
        
        return response([
            'status' => 'success',
            'data' => $category
           ], 200);
    }
    
    
    public function delete_group(EditGroupRequest $request){
        
        $group = Group::find($request->id);
        $group->forceDelete();

        return response([
            'status' => 'success',
           ], 200);
        
    }
    
    public function get_all_groups(AllGroupRequest $request){
        
        $groups = Group::orderBy('created_at', 'desc')->where('category_id',$request->id)->get();
        
         return response([
            'status' => 'success',
            'data' => $groups
           ], 200);
    }
    
    
    
    
    
}



