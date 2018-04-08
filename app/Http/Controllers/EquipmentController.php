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
        $equipments = Equipment::orderBy('created_at', 'desc')->get();
        
        $equipments_array = array();
        
        foreach($equipments as $equipment){
            $category = Category::find($equipment->category_id);
            
            $equipment_to_add = array(
              'name' => $equipment->name,
              'serial' => $equipment->serial,
              'category' => $category->name,
            );
            
            array_push($equipments_array, $equipment_to_add);
            
        }
        
         return response([
            'status' => 'success',
            'data' => $equipments_array
           ], 200);
    }
   
}
