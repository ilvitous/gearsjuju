<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Equipment;
use App\Http\Requests\AddNewCategoryRequest;
use App\Http\Requests\EditCategoryRequest;



class CategoryController extends Controller
{
    //
    
    public function add_new_category(AddNewCategoryRequest $request){
        $category = new Category;
        $category->name = $request->name;
        $category->save();
        return response([
            'status' => 'success',
            'data' => $category
           ], 200);
    }
    
    
    public function get_all_categories(){
        $categories = Category::orderBy('created_at', 'desc')->get();
        
        foreach($categories as $category){
            
            $equipment = new Equipment;
            $category->category_count = $equipment->get_category_quanity($category->id);
        }
        
         return response([
            'status' => 'success',
            'data' => $categories
           ], 200);
    }
    
    
    public function edit_category(EditCategoryRequest $request){
        
        $category = Category::find($request->id);
        $category->name = $request->name;
        
        $category->save();
        return response([
            'status' => 'success',
            'data' => $category
           ], 200);
        
    }
    
    public function delete_category(EditCategoryRequest $request){
        
        $category = Category::find($request->id);
        $category->forceDelete();

        return response([
            'status' => 'success',
           ], 200);
        
    }
    
    
    
    
    
    
}
