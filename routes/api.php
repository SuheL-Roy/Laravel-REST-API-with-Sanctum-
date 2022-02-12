<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
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
Route::post("/reg",[UserController::class,"register"]);
Route::post("/log",[UserController::class,"login"]);
Route::middleware('auth:sanctum')->group(function(){
Route::get("/allStd",[StudentController::class,"index"]);
Route::get("/allStd/{id}",[StudentController::class,"show"]);
Route::post("/allStd",[StudentController::class,"store"]);
Route::put("/update/{id}",[StudentController::class,"edit"]); 
Route::delete("/destroy/{id}",[StudentController::class,"destroy"]); 
Route::get("/search/{city}",[StudentController::class,"search"]);
Route::post("/logouts",[UserController::class,"logout"]);

});



 
