<?php

use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\TestController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// api doctor paginate 5
Route::get('/doctors', [DoctorController::class, 'index']);
//api singolo dottore per slug
Route::get('/doctors/{slug}', [DoctorController::class, 'show']);
// api lead dottore
Route::post('/doctor', [LeadController::class, 'store']);
