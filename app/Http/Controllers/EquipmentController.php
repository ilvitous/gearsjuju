<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\Category;
use App\Gearevent;
use App\Group;
use App\User;
use App\Gearrequest;
use QrCode;
use Carbon;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


use App\Http\Requests\AddNewEquipmentRequest;
use App\Http\Requests\DeleteEquipmentRequest;
use App\Http\Requests\EditEquipmentRequest;
use App\Http\Requests\CheckInEquipmentRequest;
use App\Http\Requests\CheckOutEquipmentRequest;
use App\Http\Requests\AssignEquipmentRequest;
use App\Http\Requests\UnassignEquipmentRequest;





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
        
        
        if($request->group){
             $equipment->groups()->attach($request->group);
        }
        
        
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
                    $event = null;
                    if($equipment->gearevent_id){
                        $event = Gearevent::find($equipment->gearevent_id);
                    }
                    
                    $group = null;
                    if($equipment->groups){
                        $group = $equipment->groups;
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
                        'group' => $group
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
    
    
    public function assign_equipment(AssignEquipmentRequest $request){
        
        // 'event' => 'required',
        // 'equipment_id' => 'required',
        // 'user' => 'required',
        // 'equipment_request' => 'required',
        // 'gear_request' => 'required',
        
        date_default_timezone_set('America/Phoenix');
        
        $equipment = Equipment::find($request->equipment_id);
        $event = Gearevent::find($request->event);
        
        // add event to equipment
        $equipment->gearevent()->associate($event);
        
        // add assigned pride associate
        $user = User::find($request->user);
        $equipment->user()->associate($user);
        
        // add gear_request to equipment
        $gearRequest = Gearrequest::find($request->gear_request);
        $equipment->gearrequest()->associate($gearRequest);
        
        
        
        $equipment->save();
        
        // assignament stuff
        $assignArray = array();
        $assigned = $gearRequest->assigned;
       
        
        if($assigned){
            $assign = array(
                'id' => $equipment->id,
                'name' => $equipment->name,
                'equipment_request' => $request->equipment_request,
                'assign_date'=> Carbon\Carbon::now()
            );
        
            $assignedArray = json_decode($assigned);
            array_push($assignedArray,$assign);
            
            $gearRequest->assigned = json_encode($assignedArray);
            
        }else{
            
            
            $assign = array(
                array(
                'id' => $equipment->id,
                'name' => $equipment->name,
                'equipment_request' => $request->equipment_request,
                'assign_date'=> Carbon\Carbon::now()
                ),
            );
        
            $gearRequest->assigned = json_encode($assign);
        }
        
        //$gearRequest->assigned = '';
       
       
        $gearRequest->save();
        
        
        return response([
            'status' => 'success',
            'data' => $assign 
           ], 200);
        
        
    }
    
    public function unassign_equipment(UnassignEquipmentRequest $request){
        
        $equipment = Equipment::find($request->equipment_id);
        $gearRequest = Gearrequest::find($equipment->gearrequest_id);
        $assigned = $gearRequest->assigned;
        $assignedArray = json_decode($assigned);
        
        $assignedEquipments = $assignedArray;
        
        $i=0;
        foreach($assignedEquipments as $assignedEquipment){
            if( $assignedEquipment->equipment_request == $request->equipment_request){
                unset($assignedArray[0]);
            }
            $i++;
        }
        $assignedArray = array_values($assignedArray);
        
        $equipment->gearrequest_id = null;
        $equipment->gearevent_id = null;
        $equipment->user_id = null;
        $equipment->save();
        
        $gearRequest->assigned = json_encode($assignedArray);
        $gearRequest->save();
        
        
         return response([
            'status' => 'success',
            'data' =>  $assignedArray 
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
    
    
    public function get_all_equipments_for_request(){
        
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

                     
                    
                    
                    if(count($equipment->groups) > 0){
                    
                        foreach($equipment->groups as $group){
                            
                            $equipment_to_add = array(
                            'id' => $group->id,           
                            'name' => $group->name,
                            'type' => 'group',
                            );
                            
                            array_push($category_array['equipments'], $equipment_to_add);
                        }
                    

                    }else{
                        
                        $equipment_to_add = array(
                        'id' => $equipment->id,           
                        'name' => $equipment->name,
                        'type' => 'product',
                        );
                        
                        array_push($category_array['equipments'], $equipment_to_add);
                    }
                    
                    
                    
                    
                   
                    
                }
                
                $category_array['equipments'] = array_unique( $category_array['equipments'], SORT_REGULAR);
                
                array_push($equipments_array, $category_array );
                
            }
            
        }
        
        return response([
            'status' => 'success',
            'data' => $equipments_array
           ], 200);
    }
   
}
