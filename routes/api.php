<?php


use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;



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

// Default Route
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// testin Route
// Route::get('test',function(){
    // return 'hello';
    // return response()->json(['data'=>'hello php','message'=>'success'],200);
    // return ResponseHelper::success('hello php');
//     return ResponseHelper::fail('user not found');
// });

// Registor Route
Route::post('register',[AuthController::Class,'register']);
Route::post('login',[AuthController::Class,'login']);