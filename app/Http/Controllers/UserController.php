<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    
    public function users_all(){
    $users_array = array();    
    $users = User::all();
    
    foreach($users as $user){
        
        
        $name = $user->name;
        $email = $user->email;
        $id = $user->id;
        $role = $user->roles()->first(); 
        
        $user_to_add = array(
         
         'name' => $name,
         'email' => $email,
         'id' => $id,
         'role'  => $role->name,
        
            
        );
        
        array_push($users_array,$user_to_add);
        
    }
    
    return response([
            'status' => 'success',
            'data' =>  $users_array
        ]);
    }


}
