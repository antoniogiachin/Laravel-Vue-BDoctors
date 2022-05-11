@extends('layouts.app')

@section('content')

@php
  $user = Auth::user();
  $name = $user->name;
  $surname = $user->surname;
  $email = $user->email;
  $address = $user->address;
@endphp

    <div class="row">
        <div class="col-6 mx-auto">
            @if (session('alreadyCreated'))
                <div class="alert alert-danger" role="alert">
                    {{ session('alreadyCreated') }}
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>
    <div class="container mt-4 bg-light d-flex justify-content-around border">
        {{-- sidebar info dottore --}}
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-info border-end me-3" style="width: 280px;">
            @if (!$doctor->photo)
                <img src=" {{ asset('img/not_found.jpg') }} " alt="not_found_photo" class="img-fluid py-2">
            @else
                <img src=" {{ asset('storage/' . $doctor->photo) }} " alt="{{ $doctor->id }}_photo" class="img-fluid py-2">
            @endif
            <h5>{{$name}} {{$surname}}</h5>
            <div class="div d-flex flex-wrap mt-2">
                @foreach ($doctor->specialties as $specialty)
                    <span class="badge bg-light text-dark m-1">{{ $specialty->name }}</span>
                @endforeach
            </div>
           
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <p><i class="fa-solid fa-location-pin"></i>
                        @if(!$doctor->medical_address)
                            <span>Studio non presente</span>
                        @else
                            <span> {{$doctor->medical_address}}</span>
                        @endif
                    </p>
                </li>
                <li>
                    <p><i class="fa-solid fa-envelope"></i> {{$email}}</p>
                </li>
                <li>
                    <p><i class="fa-solid fa-phone"></i>
                        @if(!$doctor->cv)
                            <span>telefono non presente</span>
                        @else
                           <span>{{$doctor->phone}}</span>
                        @endif
                    </p>
                </li>
                <li>
                    <p><i class="fa-solid fa-file"></i>
                        @if(!$doctor->cv)
                            <span>Nessun cv</span>
                        @else
                            <a class="nav-link text-dark d-inline" href="{{url('storage/'. Auth::user()->doctor->cv)}}">Guarda Cv</a>
                        @endif
                    </p>
                </li>
            </ul>
        </div>
        <div class="row text-center justify-content-center mt-3">
            <div class="col-md-6 col-sm-12 d-flex justify-content-center align-items-center ms_hov_active">
                <h4><i class="fa-solid fa-gears"></i><a class="nav-link text-dark d-inline" href="{{route('admin.doctors.edit', $doctor->slug)}}">Modifica Profilo</a></h4>
            </div>
            <div class="col-md-6 col-sm-12 d-flex justify-content-center align-items-center ms_hov_active">
               <h4><i class="fa-solid fa-message"></i><a class="nav-link text-dark d-inline" href="#">Messaggi ricevuti</a></h4>
            </div>
            <div class="col-md-6 col-sm-12 d-flex justify-content-center align-items-center ms_hov_active">
               <h4><i class="fa-solid fa-comments"></i><a class="nav-link text-dark d-inline" href="#">Recensioni ricevute</a></h4>
            </div>
            <div class="col-md-6 col-sm-12 d-flex justify-content-center align-items-center ms_hov_active">
               <h4><i class="fa-solid fa-chart-line"></i><a class="nav-link text-dark d-inline" href="#">Statistiche</a></h4>
            </div>
            <div class="col-md-6 col-sm-12 d-flex justify-content-center align-items-center ms_hov_active">
               <h4><i class="fa-solid fa-circle-plus"></i><a class="nav-link text-dark d-inline" href="#">Aggiungi Sponsor</a></h4>
            </div>
            <div class="col-md-6 col-sm-2 d-flex justify-content-center align-items-center ms_hov_active">
                {{-- Da aggiungere condizione: se il dott. ha sponsor attivi mostra "sponsor attivi", altrimenti mostra "nessuno sponsor attivo" --}}
               <h4><i class="fa-solid fa-stamp"></i><a class="nav-link text-dark d-inline" href="#">Nessuno sponsor attivo</a></h4>
            </div>
        </div>

    </div>
@endsection
