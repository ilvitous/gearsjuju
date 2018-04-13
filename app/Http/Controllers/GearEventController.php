<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gearevent;
use App\Equipment;
use App\Category;
use App\User;
use App\Http\Requests\AddNewEventRequest;
use App\Http\Requests\DeleteEventRequest;
use App\Http\Requests\EditEventRequest;
use App\Http\Requests\SingleEventRequest;



class GearEventController extends Controller
{
    //
    
    public function get_all_events(){
        $events = Gearevent::orderBy('created_at', 'desc')->where('archived', false)->get();
        
        foreach ($events as $event){
            $equipments = Equipment::where('gearevent_id', $event->id)->get();
            
            if( count($equipments) > 0 ){
                
                $event->equipments = true;
            }
        }
        
         return response([
            'status' => 'success',
            'data' => $events
           ], 200);
    }
    
    
     public function get_all_archived_events(){
        $events = Gearevent::orderBy('created_at', 'desc')->where('archived', true)->get();
         return response([
            'status' => 'success',
            'data' => $events
           ], 200);
    }
    
    
    public function add_new_event(AddNewEventRequest $request){
        
        $dates = json_encode($request->dates);
        $event = new Gearevent;
        $event->title = $request->title;
        $event->dates = $dates;
        $event->address = $request->address;
        $event->archived = false;
        
        $event->save();
        
        return response([
            'status' => 'success',
            'data' => $event
           ], 200);
           
           
        
    }
    
    
    public function delete_event(DeleteEventRequest $request){
        $event = Gearevent::find($request->id);
        $event->forceDelete();
        return response([
            'status' => 'success',
           ], 200);

    }
    
    
    public function archive_event(DeleteEventRequest $request){
        $event = Gearevent::find($request->id);
        $event->archived = true;
        $event->save();
        return response([
            'status' => 'success',
           ], 200);

    }
    
    
    public function edit_event(EditEventRequest $request){
        $dates = json_encode($request->dates);
        $event = Gearevent::find($request->id);
        $event->title = $request->title;
        $event->address = $request->address;
        $event->dates = $dates;
        $event->save();
        
        return response([
            'status' => 'success',
             'data' => $event
           ], 200);

    }
    
    
    public function single_event(SingleEventRequest $request){
        
        $event = Gearevent::find($request->id);
        $equipments = Equipment::orderBy('created_at', 'desc')->where('gearevent_id', $request->id)->get();
        $equipments_array = array();
        
        if(count($equipments)>0){
                
                $equipments_array = array();
                $categories = array();
                foreach ($equipments as $equipment) {
                    $categories[] = $equipment->category_id;
                }
                $uniqueCategories = array_unique($categories);
                
            foreach($uniqueCategories as $category){
                
                $equipments_filtered = array();
                
                foreach($equipments as $equipment){
                    if($equipment->category_id == $category){
                        array_push($equipments_filtered,$equipment);
                    }
                }
                $category_obj = Category::find($category);

                $category_array = array(
                'category' => $category_obj->name,
                'equipments' => array()
                );
                
                foreach($equipments_filtered as $equipment_filtered){
                    
                    $user = User::find($equipment_filtered->user_id);
                    
                    $equipment_to_add = array(
                        'id' => $equipment_filtered->id,           
                        'name' => $equipment_filtered->name,
                        'serial' => $equipment_filtered->serial,
                        'chekout' => $equipment_filtered->chekout,
                        'chekout_date' => $equipment_filtered->chekout_date,
                        'assigned_to' => $equipment_filtered->assigned_to,
                        'category_name' => $category_obj->name,
                        'category_id' => $category,
                        'user' => $user
                    );
                    
                    
                    
                    array_push($category_array['equipments'], $equipment_to_add);
                }
                array_push($equipments_array, $category_array);
                
            }
                
                
                
        }
            
        
       
        
        
        
        return response([
            'status' => 'success',
             'data' => $event,
             'equipments' => $equipments_array,
           ], 200);
    }
    
    
    
    
    
}
