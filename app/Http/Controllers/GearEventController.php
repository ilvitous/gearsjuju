<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gearevent;
use App\Http\Requests\AddNewEventRequest;
use App\Http\Requests\DeleteEventRequest;
use App\Http\Requests\EditEventRequest;
use App\Http\Requests\SingleEventRequest;



class GearEventController extends Controller
{
    //
    
    public function get_all_events(){
        $events = Gearevent::orderBy('created_at', 'desc')->where('archived', false)->get();
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
        return response([
            'status' => 'success',
             'data' => $event
           ], 200);
    }
    
    
    
}
