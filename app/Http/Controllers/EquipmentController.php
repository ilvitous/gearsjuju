<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\Category;
use App\Gearevent;

use QrCode;
use Carbon;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


use App\Http\Requests\AddNewEquipmentRequest;
use App\Http\Requests\DeleteEquipmentRequest;
use App\Http\Requests\EditEquipmentRequest;
use App\Http\Requests\CheckInEquipmentRequest;
use App\Http\Requests\CheckOutEquipmentRequest;




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
        QrCode::generate($equipment->id, '../public/qrcodes/qrcode_'.$equipment->id.'.svg');
        
        
        
        
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
                    $event = null;
                    if($equipment->gearevent_id){
                        $event = Gearevent::find($equipment->gearevent_id);
                    }
                    
                    $equipment = array(
                        'id' => $equipment->id,           
                        'name' => $equipment->name,
                        'serial' => $equipment->serial,
                        'chekout' => $equipment->chekout,
                        'category_name' => $category->name,
                        'category_id' => $category->id,
                        'gearevent_id' => ($event ? $event->id : ''),
                        'gearevent_title' => ($event ? $event->title : ''),
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
    
    
    public function delete_equipment(DeleteEquipmentRequest $request){
       
        $equipment = Equipment::find($request->id);
        $equipment->forceDelete();
        return response([
            'status' => 'success',
           ], 200);

    }
    
    public function edit_equipment(EditEquipmentRequest $request){
        
        $equipment = Equipment::find($request->id);
        $category = Category::find($request->category);
        $equipment->name = $request->name;
        $equipment->serial = $request->serial;
        $equipment->category()->associate($category);
        $equipment->save();
        
        return response([
            'status' => 'success',
            'data' => $equipment 
           ], 200);
        
        
    }
    
    
    public function check_in_equipment(CheckInEquipmentRequest $request){
        
        date_default_timezone_set('America/Phoenix');
        
        $equipment = Equipment::find($request->id);
        $event = Gearevent::find($request->event);
        $equipment->gearevent()->associate($event);
        $equipment->chekout = true;
        $equipment->chekout_date = Carbon\Carbon::now();
        $equipment->assigned_to = $request->assigned_to;
        
        $equipment->save();
        
        return response([
            'status' => 'success',
            'data' => $equipment 
           ], 200);
        
        
    }
    
    
    public function check_out_equipment(CheckOutEquipmentRequest $request){
        
        $equipment = Equipment::find($request->id);
        $equipment->gearevent_id = NULL;
        $equipment->chekout = false;
        $equipment->chekout_date = NULL;
        $equipment->assigned_to = NULL;
        
        $equipment->save();
        
        return response([
            'status' => 'success',
            'data' => $equipment 
           ], 200);
        
        
    }
   
}
