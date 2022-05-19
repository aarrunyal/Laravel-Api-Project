<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post("login", [LoginController::class, 'loginUser']);

Route::group(["middleware"=>"auth:sanctum", "prefix"=>"xyz"], function($router){
    $router->get('logout', [LoginController::class, 'logout']);
    
    $router->apiResource("category", CategoryController::class);
    $router->apiResource("user", UserController::class);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get('users', [UserController::class, "index"]);
// Route::post('user', [UserController::class, "create"]);
// Route::put('user/{id}/update', [UserController::class, "update"]);
// Route::delete('user/{id}/delete', [UserController::class, "delete"]);
// Route::get('user/{id}', [UserController::class, "show"]);



// Route::apiResource("category", CategoryController::class);