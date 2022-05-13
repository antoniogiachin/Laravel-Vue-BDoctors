<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //
    public function index($slug){
        if(Auth::user()->doctor->slug == $slug){
            $reviews = Auth::user()->doctor->reviews->sortByDesc('created_at');
            return view('Admin.Reviews.index', compact('reviews'));
        } else {
            return redirect()->route('401');
        }
    }
}
