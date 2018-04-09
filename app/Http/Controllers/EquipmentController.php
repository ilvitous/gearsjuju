<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\Category;
use App\Http\Requests\AddNewEquipmentRequest;



class EquipmentController extends Controller
{
    //
    
    public function add_new_equipment(AddNewEquipmentRequest $request){
        
        $category = Category::find($request->category);

        $equipment = new Equipment;
        $equipment->name = $request->name;
        $equipment->serial = $request->serial;
        $equipment->category()->associate($category);
        $equipment->chekout = false;
        $equipment->chekout_date = null;
        $equipment->save();
        
        return response([
            'status' => 'success',
            'data' => $equipment 
           ], 200);
    }
    
    
    
    public function get_all_equipments(){
        
        $equipments_array = array();
        $categories = Category::orderBy('name', 'asc')->get();
        
        foreach($categories as $category){
           
            $equipments = Equipment::orderBy('created_at', 'desc')->where('category_id', $category->id)->get();
            
            if(count($equipments)>0){
                
                $category_array = array(
                'category' => $category->name,
                'equipments' => array()
                );
                
                foreach($equipments as $equipment){
                    $equipment = array(
                        'id' => $equipment->id,           
                        'name' => $equipment->name,
                        'serial' => $equipment->serial,
                        'chekout' => $equipment->chekout,
                        'category_name' => $category->name
                    );
                    array_push($category_array['equipments'], $equipment);
                }
                
                array_push($equipments_array, $category_array);
                
            }
            
        }
        
        
       

        
        
         return response([
            'status' => 'success',
            'data' => $equipments_array
           ], 200);
    }
   
}