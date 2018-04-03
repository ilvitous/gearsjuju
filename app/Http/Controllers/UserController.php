<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;

use App\Http\Requests\RegisterRoleRequest;
use App\Http\Requests\DeleteRoleRequest;
use App\Http\Requests\SetRoleRequest;



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
        
        if($role){
            $user_to_add = array(
            'name' => $name,
            'email' => $email,
            'id' => $id,
            'role'  => $role->name,
            );
        }else{
            $user_to_add = array(
             'name' => $name,
             'email' => $email,
             'id' => $id,
            );
        }
        
        
        
        array_push($users_array,$user_to_add);
        
    }
    
    return response([
            'status' => 'success',
            'data' =>  $users_array
        ]);
    }
    
    
    
    public function userCategoriesAll(){
        $roles_array = array();    
        $roles = Role::all();
    
        foreach($roles as $role){
            $name = $role->name;
            $id = $role->id;
            $role_to_add = array(
            'name' => $name,
            'id' => $id,
        );
        array_push($roles_array,$role_to_add);
        }
    
        return response([
            'status' => 'success',
            'data' =>  $roles_array
        ]);
    }
    
    
    public function registerRole(RegisterRoleRequest $request){
        $role = new Role;
        $role->name = $request->name;
        $role->description = $request->description;
        $role->save();
        
        return response([
            'status' => 'success',
            'data' => $role
           ], 200);
           
    }
    
    
     public function deleteRole(DeleteRoleRequest $request){

        $role = Role::find($request->id);
        $role->forceDelete();
        return response([
            'status' => 'success',
           ], 200);
           
    }
    
    
    public function setRole(SetRoleRequest $request){

        $role = Role::where('id', $request->role)->first();
        $user = User::find($request->user);
        $user->roles()->attach($role);
        $user->save();
        
        return response([
            'status' => 'success',
           ], 200);
           
    }


}
