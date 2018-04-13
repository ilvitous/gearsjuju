<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gearevent;
use App\User;
use App\Gearrequest;
use App\Http\Requests\AddNewRequestRequest;
use App\Http\Requests\DeleteRequestRequest;
use App\Http\Requests\GetRequestRequest;

class GearRequestController extends Controller
{
    //
    
    public function add_new_request(AddNewRequestRequest $request){
        date_default_timezone_set('America/Phoenix');
        $gearrequest = new Gearrequest;
        $gearrequest->equipment = $request->equipment;
        $event = Gearevent::find($request->event);
        $gearrequest->gearevent()->associate($event);
        $user = User::find($request->user);
        $gearrequest->users()->associate($user);
        $gearrequest->save();
        return response([
            'status' => 'success',
            'data' => $gearrequest,
           ], 200);
    }
    
    public function get_all_requests(GetRequestRequest $request){
        
        $gearRequests = Gearrequest::orderBy('created_at', 'desc')->where('gearevent_id', $request->event_id)->get();
        
        foreach($gearRequests as $gearRequest){
            $user = User::find($gearRequest->users_id);
            $gearRequest->user = $user;
        }
        
        
         return response([
            'status' => 'success',
            'data' => $gearRequests,
           ], 200);
    }
    
    public function delete_request(DeleteRequestRequest $request){
        
        $gearRequests = Gearrequest::find($request->id);
        $gearRequests->forceDelete();
       
        return response([
        'status' => 'success',
        ], 200);
    }
    
    
    
    
    
}
