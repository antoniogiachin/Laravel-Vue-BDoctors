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
        $doctors = Doctor::with(["user", "specialties"])->paginate(2);

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
        $doctors = Doctor::with(["reviews", "user"])->get();
        $filterByVote = $doctors->filter(function ($doctor) use ($average) {
            $averageVote = 0;
            $sum = 0;
            foreach ($doctor->reviews as $review) {
                $sum += $review->vote;
            }
            $averageVote = $sum / count($doctor->reviews);
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
                "results" => $filterByVote,
            ]);
        } else {
            return response()->json([
                "success" => false,
                "results" => "Nessun Medico con questa media voti!",
            ]);
        }
    }
}
