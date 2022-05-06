<?php

namespace App\Http\Controllers\Admin;

use App\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(){

        $doctor = Doctor::where('user_id', Auth::user()->id)->first();

        return view ('admin.home', compact('doctor'));
    }

}
