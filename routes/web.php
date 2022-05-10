<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\NotFoundController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::middleware('auth')
->namespace('Admin')
->name('admin.')
->prefix('admin')
->group(
    function(){
        // rotta dashboard
        Route::get('/', 'HomeController@index')->name('home');
        //rotta destroy user dashboard
        Route::delete('/{user}', 'HomeController@destroy')->name('home.destroy');
        Route::get('/{user}', 'HomeController@show')->name('home.show');
        // rotte CRUD dottore
        Route::resource('doctors', 'DoctorController');
        //rotta get e delete cv
        Route::get('/cvDownload', 'CvController@getCv')->name('downloadCv');
        Route::get('cvDelete/{doctor}', 'CvController@cvDelete')->name('deleteCv');
        //rotta delete photo
        Route::get('/photoDelete/{doctor}', "PhotoController@photoDelete")->name('deletePhoto');
        //rotta view messaggi dottore
        // Route::get('/leads', 'LeadController@index')->name('leads');
    }
);

Route::get("/", function () {
    return view('guests.home');
})->name('guests.home');

// rotta 404
Route::get('/notfound', [NotFoundController::class, 'index'])->name('404');
Route::get('/unauthorized', [NotFoundController::class, 'unauthorized'])->name('401');


Route::get('{any?}', function() {
    return view('guests.home');
})->where('any', '.*');


