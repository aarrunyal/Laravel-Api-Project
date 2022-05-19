<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    


    public function hello(){
        $json = [
            "id"=>"123",
            "name"=>"abcd"
        ];
        return response()->json($json);
    }
}
