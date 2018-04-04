<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gearevent;

class GearEventController extends Controller
{
    //
    
    public function get_all_events(){
        
        
        $events = Gearevent::orderBy('created_at', 'desc')->get();
        
        
        
         return response([
            'status' => 'success',
            'data' => $events
           ], 200);
    
    
    
    }
    
}
