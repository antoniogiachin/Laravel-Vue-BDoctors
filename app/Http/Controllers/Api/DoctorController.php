<?php

namespace App\Http\Controllers\Api;

use App\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    //
    public function index(){

        $doctors = Doctor::with(['user', 'specialties'])->paginate(5);

        $doctors->each(function($doctor){
            //se ho photo
            if($doctor->photo){
                $doctor->photo = url('storage/' . $doctor->photo);
            } else {
                $doctor->photo = url('img/not_found.jpg');
            }

            if($doctor->cv){
                $doctor->cv = url('storage/' . $doctor->cv);
            } else {
                $doctor->cv = 'Nessun Curriculum presente!';
            }
        });

        return response()->json(
            [
                'results' => $doctors,
                'success' => true,
            ]
        );


    }

    //singolo dottore
    public function show($slug){

        $doctor = Doctor::where('slug', $slug)->with(['user', 'specialties'])->first();

        //se ho photo
        if ($doctor->photo) {
            $doctor->photo = url('storage/' . $doctor->photo);
        } else {
            $doctor->photo = url('img/not_found.jpg');
        }

        if ($doctor->cv) {
            $doctor->cv = url('storage/' . $doctor->cv);
        } else {
            $doctor->cv = 'Nessun Curriculum presente!';
        }

        return response()->json(
            [
                'results' => $doctor,
                'success' => true,
            ]
        );

    }
}
