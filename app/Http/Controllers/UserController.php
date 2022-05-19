<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $users = User::get();
        return response($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['password']= bcrypt($data['password']);

        if(User::create($data))
            return response(['status'=>"OK", "response"=>"User created successfully"]);
        return response(['status'=>"ERROR", "response"=>"NO DATA FOUND"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if(empty($user))
            return response(['status'=>"ERROR", "response"=>"NO DATA FOUND"]); 
        if($user->delete())
            return response(['status'=>"OK", "user"=>$user]);
        return response(['status'=>"ERROR", "response"=>"NO DATA FOUND"]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if(empty($user))
            return response(['status'=>"ERROR", "response"=>"NO DATA FOUND"]); 
        $data = $request->all();
        if($user->update($data))
            return response(['status'=>"OK", "response"=>"User updated successfully"]);
        return response(['status'=>"ERROR", "response"=>"NO DATA FOUND"]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
        $user = User::find($id);
        if(empty($user))
            return response(['status'=>"ERROR", "response"=>"NO DATA FOUND"]); 
        if($user->delete())
            return response(['status'=>"OK", "response"=>"User deleted successfully"]);
        return response(['status'=>"ERROR", "response"=>"NO DATA FOUND"]); 
    }
}
