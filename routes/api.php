<?php

use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\SpecialtyController;
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

//api get specialties
Route::get('/', [SpecialtyController::class, 'getSpecialties']);

//api provvisorio per ottenere i dottori nella HOME
Route::get('/docs', [DoctorController::class, 'getAllDoctors']);


// api doctor paginate 5
Route::get('/doctors', [DoctorController::class, 'index']);
//api singolo dottore per slug
Route::get('/doctors/{slug}', [DoctorController::class, 'show']);
