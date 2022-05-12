@extends('layouts.app')

@section('content')


{{--  --}}
{{--@php
  $user = Auth::user();
  $name = $user->name;
  $surname = $user->surname;
  $email = $user->email;
  $address = $user->address;
@endphp--}}

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

    {{-- Se un utente non ha registrato un profilo da dottore --}}
    @if (!$doctor)
    <div class="text-center pt-3">
        <h2>La piattaforma per i medici professionisti.</h2>
        <p class="fw-bold">Completa subito il tuo profilo!</p>
    </div>
    {{-- Hero section --}}
    <div class="container hero-register">
        <div class="text-right d-flex flex-column align-items-end">
            {{-- creazione profilo dottore --}}
            <div class="col-6 d-flex justify-content-center">
                <a href="{{ route('admin.doctors.create') }}" class="btn mt-3 text-white btn-success">Registra il tuo profilo da dottore</a>
            </div>
            {{-- eliminazione user --}}
            <div class="col-6 d-flex justify-content-center">
                <form action="{{ route('admin.home.destroy', $user->id) }}" id="deleteUser" method="POST">
                    @csrf

                    @method('DELETE')

                    <button class=" btn btn-danger text-white mt-3" type="submit">Elimina il tuo profilo</button>
                </form>
            </div>
        </div>
    </div>

        {{-- Se utente ha registrsto un profilo --}}
    @else
    <div class="container position-relative mt-4 bg-light d-flex justify-content-around border rounded-3 p-0">

        {{-- sidebar info dottore --}}
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-info border-end me-3 rounded-start" style="width: 280px;">
            @if (!$doctor->photo)
                <img src=" {{ asset('img/not_found.jpg') }} " alt="not_found_photo" class="img-fluid py-2">
            @else
                <img src=" {{ asset('storage/' . $doctor->photo) }} " alt="{{ $doctor->id }}_photo" class="img-fluid py-2">
            @endif
            <h5>{{$doctor->user->name}} {{$doctor->user->surname}}</h5>
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
                    <p><i class="fa-solid fa-envelope"></i> {{$doctor->user->email}}</p>
                </li>
                <li>
                    <p><i class="fa-solid fa-phone"></i>
                        @if(!$doctor->phone)
                            <span>Telefono non presente</span>
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
                            <a class="nav-link text-dark text-decoration-underline d-inline" href="{{url('storage/'. Auth::user()->doctor->cv)}}">Guarda Cv</a>
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
        <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" class="delete-profile position-absolute top-0 end-0" data-name="{{$doctor->user->surname}}">
            @csrf
            @method('DELETE')

            <button class="btn btn-danger text-white">Elimina profilo</button>
        </form>
        @endif
    </div>


    {{-- OLD --}}

@endsection
