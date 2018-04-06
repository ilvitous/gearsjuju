<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\AddNewCategoryRequest;

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
         return response([
            'status' => 'success',
            'data' => $categories
           ], 200);
    }
    
    
    
}
