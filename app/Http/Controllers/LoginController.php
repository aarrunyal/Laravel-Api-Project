<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

 class LoginController{


      public function loginUser(Request $request){
                  $request->validate([
                        "email"=>"required|email",
                        "password"=>"required",
                  ]);

                  $user = User::whereEmail($request->get('email'))->first();
                  if (! $user || ! Hash::check($request->password, $user->password)) {
                        throw ValidationException::withMessages([
                            'email' => ['The provided credentials are incorrect.'],
                        ]);
                    }else{
                          Auth::login($user);
                          if(auth()->check()){
                              $randomText =  hash_hmac('sha256', Str::random(40), config('app.key'));
                              $user->token =  $user->createToken($randomText)->plainTextToken;
                              return $user;
                          }
                    }
      }

      public function logout(){

            if(!auth()->check())
                  return response(['Status'=>"ERROR", "response"=>"No logged in user found"]);
            else{
                  $user = auth()->user();
                  auth()->guard('web')->logout();
                  $user->tokens->each(function($tkn){
                        $tkn->delete();
                  });
                  return response(['Status'=>"OK", "response"=>"User Logged out successfully"]);
            }
      }
 }