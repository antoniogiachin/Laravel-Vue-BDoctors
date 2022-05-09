<?php

namespace App\Http\Controllers\Admin;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Comparator\Comparator;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // recupero specializzazioni
        $specialties = Specialty::all();
        $doctor = Auth::user()->doctor;

        if(!Auth::user()->doctor){
            return view('Admin.Doctors.create', compact('specialties'));
        } else{
            return redirect()->route('admin.home', compact('doctor'))->with('alreadyCreated', 'Hai già creato il tuo profilo!');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Doctor $doctor)
    {
        //
        $request->validate(
            [
                'medical_address' => 'nullable|min:2',
                'performance' => 'nullable|min:10',
                'phone' => 'nullable|min:2|numeric',
                'photo' => 'nullable|mimes:png,jpg,jpeg|max:4096',
                'cvBlob' => 'nullable|file|max:4096',
                'specialtiesId' => 'nullable|exists:specialties,id'
            ]
        );

        $data = $request->all();

        $slug  = Str::slug(Auth::user()->name . "-" . Auth::user()->surname );

        // slug unico
        $counter = 1;

        while (Doctor::where('slug', $slug)->first()) {
            // se è già presente aggiunge il counter allo slug creato
            $slug  = Str::slug(Auth::user()->name . "-" . Auth::user()->surname) . '-' . $counter;
            $counter++;
        };

        $data['slug'] = $slug;

        if(!isset($data['specialtiesId'])){
            $data['specialtiesId'] = "Nessuna specializzazione selezionata!";
        }

        if(isset($data['photo'])){
            $imageUrl = Storage::put('doc_img', $data['photo']);
            $data['photo'] = $imageUrl;
        }

        if(isset($data['cvBlob'])){
            $cvUrl = Storage::put('doc_cv', $data['cvBlob']);
            $data['cv'] = $cvUrl;
        }

        $data['user_id'] = Auth::user()->id;

        // dd($data);

        $doctor->fill($data);
        $doctor->save();

        if (isset($data['specialtiesId'])) {
            $doctor->specialties()->sync($data['specialtiesId']);
        }

        return redirect()->route('admin.home')->with('status', 'Profilo creato con successo!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $doctor = Doctor::where('slug', $slug)->first();
        return view('Admin.Doctors.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        // dd($doctor->id);
        $specialties = Specialty::all();
        $doctor = Doctor::where('slug', $slug)->first();
        if(Auth::user()->doctor && Auth::user()->doctor->id == $doctor->id){
            return view('Admin.Doctors.edit', compact('doctor', 'specialties'));
            // return view('Admin.Doctors.edit', compact('doctor', 'specialties'));
        } else {
            return redirect()->route('401');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
        $request->validate(
            [
                'medical_address' => 'nullable|min:2',
                'performance' => 'nullable|min:10',
                'phone' => 'nullable|min:2|numeric',
                'photo' => 'nullable|mimes:png,jpg,jpeg|max:4096',
                'cvBlob' => 'nullable|file|max:4096',
                'specialtiesId' => 'nullable|exists:specialties,id'
            ]
        );

        $data = $request->all();

        $slug  = Str::slug(Auth::user()->name . "-" . Auth::user()->surname);

        if(Doctor::where('slug', $slug)->first()){
            $counter = 1;
            while (Doctor::where('slug', $slug)->first()) {
                // se è già presente aggiunge il counter allo slug creato
                $slug  = Str::slug(Auth::user()->name . "-" . Auth::user()->surname) . '-' . $counter;
                $counter++;
            };
        }

        $data['slug'] = $slug;

        if (!isset($data['specialtiesId'])) {
            $data['specialtiesId'] = "Nessuna specializzazione selezionata!";
            return redirect()->route('admin.doctors.edit', compact('doctor'));
        }

        if (isset($data['photo'])) {
            //ma voglio anche rimuovere l'immagine vecchia se presente
            if ($doctor->photo) {
                Storage::delete($doctor->photo);
            }

            $imageUrl = Storage::put('doc_img', $data['photo']);
            $data['photo'] = $imageUrl;

        }

        if (isset($data['cvBlob'])) {

            if ($doctor->cv) {
                Storage::delete($doctor->cv);
            }

            $cvUrl = Storage::put('doc_cv', $data['cvBlob']);
            $data['cv'] = $cvUrl;
        }

        // dd($data);
        $doctor->update($data);
        $doctor->save();

        if (isset($data['specialtiesId'])) {
            $doctor->specialties()->sync($data['specialtiesId']);

        }

        return redirect()->route('admin.home')->with('status', 'Profilo aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        //
        if($doctor->photo){
            Storage::delete($doctor->photo);
        }

        if($doctor->cv){
            Storage::delete($doctor->cv);
        }

        $doctor->delete();

        return redirect()->route('admin.home')->with('alreadyCreated', 'Profilo eliminato con successo!');
    }
}
