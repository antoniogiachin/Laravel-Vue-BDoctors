<?php

namespace App\Http\Controllers\Api;

use App\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    //
    public function index()
    {
        $doctors = Doctor::with(["user", "specialties"])->paginate(10);

        $doctors->each(function ($doctor) {
            //se ho photo
            if ($doctor->photo) {
                $doctor->photo = url("storage/" . $doctor->photo);
            } else {
                $doctor->photo = url("img/not_found.jpg");
            }

            if ($doctor->cv) {
                $doctor->cv = url("storage/" . $doctor->cv);
            } else {
                $doctor->cv = "Nessun Curriculum presente!";
            }
        });

        return response()->json([
            "results" => $doctors,
            "success" => true,
        ]);
    }

    //singolo dottore
    public function show($slug)
    {
        $doctor = Doctor::where("slug", $slug)
            ->with(["user", "specialties"])
            ->first();

        if (!$doctor) {
            return response()->json([
                "results" => "Nessun dottore corrisponde alla ricerca",
                "success" => false,
            ]);
        } else {
            //se ho photo
            if ($doctor->photo) {
                $doctor->photo = url("storage/" . $doctor->photo);
            } else {
                $doctor->photo = url("img/not_found.jpg");
            }

            if ($doctor->cv) {
                $doctor->cv = url("storage/" . $doctor->cv);
            } else {
                $doctor->cv = "Nessun Curriculum presente!";
            }

            return response()->json([
                "results" => $doctor,
                "success" => true,
            ]);
        }
    }

    //funzione provvisoria per ottenere i dottori nella HOME
    public function getAllDoctors()
    {
        $doctors = Doctor::with(["user", "specialties"])->get();

        //immagini in home
        $doctors->each(function ($doctor) {
            //se ho photo
            if ($doctor->photo) {
                $doctor->photo = url("storage/" . $doctor->photo);
            } else {
                $doctor->photo = url("img/not_found.jpg");
            }

            if ($doctor->cv) {
                $doctor->cv = url("storage/" . $doctor->cv);
            } else {
                $doctor->cv = "Nessun Curriculum presente!";
            }
        });

        return response()->json([
            "results" => $doctors,
            "success" => true,
        ]);
    }

    public function doctorByVote($average)
    {
        $doctors = Doctor::with(["reviews", "user", "specialties", "leads"])->get();
        $filterByVote = $doctors->filter(function ($doctor) use ($average) {
            $averageVote = null;
            $sum = 0;
            foreach ($doctor->reviews as $review) {
                $sum += $review->vote;
            }
            if(count($doctor->reviews) == 0){
                $averageVote = 0;
            }else{
                $averageVote = $sum / count($doctor->reviews);
            }
//            dd($averageVote, intval($average));
            if (
                $averageVote >= intval($average) &&
                $averageVote < intval($average) + 1
            ) {
                return true;
            } else {
                return false;
            }
        });

        if (count($filterByVote) > 0) {
            return response()->json([
                "success" => true,
                "average" => 'Media voto: ' . $average,
                "results" => $filterByVote,
            ]);
        } else {
            return response()->json([
                "success" => false,
                "results" => "Nessun Medico con questa media voti!",
            ]);
        }
    }

    public function doctorByReviews($rangeMin, $rangeMax){
        $doctors = Doctor::with(["reviews", "user", "specialties"])->get();
        $filterByReviews = $doctors->filter(function($doctor) use ($rangeMin, $rangeMax){
            $reviewCounter = 0;
            foreach ($doctor->reviews as $review){
                $reviewCounter++;
            }
            if($rangeMax == 10){
                if($reviewCounter >= $rangeMin ){
                    return true;
                } else {
                    return false;
                }
            } else {
                if($reviewCounter >= $rangeMin && $reviewCounter < $rangeMax ){
                    return true;
                } else{
                    return false;
                }
            }
        });

        if(count($filterByReviews) > 0){
            return response()->json(
                [
                    'success' => true,
                    'range' => 'Numero recensioni compreso tra ' . $rangeMin . ' e ' . $rangeMax,
                    'results' => $filterByReviews,
                ]
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'results' => 'Nessun medico con questo numero di recensioni!',
                ]
            );
        }
    }
}
