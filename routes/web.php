<?php

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
        // rotte CRUD dottore
        Route::resource('doctors', 'DoctorController');
        //rotta get cv
        Route::get('/cvDownload', 'CvController@getCv')->name('downloadCv');
    }
);

Route::get("/", function () {
    return view('guests.home');
})->name('guests.home');

// rotta 404
Route::get('/notfound', [NotFoundController::class, 'index'])->name('404');
