<?php

namespace App\Http\Controllers\Api;

use App\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    //
    public function index(){

        $doctors = Doctor::with(['user', 'specialties'])->paginate(2);

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

        if(!$doctor){
            return response()->json(
                [
                    'results' => 'Nessun dottore corrisponde alla ricerca',
                    'success' => false,
                ]
            );
        } else {
            
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
}
