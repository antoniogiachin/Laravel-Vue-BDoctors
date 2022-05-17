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
    <div class="container mt-4 bg-light border rounded-3 p-0">

        {{-- Navbar link --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-info bg-gradient ms-auto">
            <div class="container-fluid">
                <button class="navbar-toggler m-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse mt-3" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto m-2 mb-lg-0">
                        <li class="nav-item m-2" id="nav-hov">
                            <a class="nav-link text-white d-inline" href="{{route('admin.doctors.edit', $doctor->slug)}}">Modifica Profilo</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link text-white d-inline" href="{{route('admin.leads', $doctor->slug)}}">Messaggi ricevuti</a>
                        </li>
                        <li class="nav-item m-2 dropdown">
                            <a class="nav-link text-white d-inline" href="{{route('admin.reviews', $doctor->slug)}}">Recensioni ricevute</a>
                        </li>
                        <li class="nav-item m-2 dropdown">
                            <a class="nav-link text-white d-inline" href="#">Statistiche</a>
                        </li>
                        <li class="nav-item m-2 dropdown">
                            <a class="nav-link text-white d-inline" href="{{route('admin.subscription.index', $doctor->slug)}}">Aggiungi Sponsor</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

        {{-- Info dottore --}}
        <div class="container text-center mt-5 border p-3" id="info">
            <div class="row gy-3">
                <div class="col-12 col-sm-6">
                    @if (!$doctor->photo)
                        <h4 class="fs-3 text-capitalize fw-bold">{{$doctor->user->name}} {{$doctor->user->surname}}</h4>
                        <img src=" {{ asset('img/not_found.jpg') }} " alt="not_found_photo" class="img-fluid py-2 rounded-pill">
                    @else
                        <h4 class="fs-3 text-capitalize fw-bold">{{$doctor->user->name}} {{$doctor->user->surname}}</h4>
                        <img src=" {{ asset('storage/' . $doctor->photo) }} " alt="{{ $doctor->id }}_photo" class="img-fluid py-2 rounded-pill" height="200px" width="200px">
                    @endif
                    <div class="div d-flex flex-wrap mt-2 justify-content-center">
                        @foreach ($doctor->specialties as $specialty)
                            <span class="badge bg-primary m-1">{{ $specialty->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-sm-6">

                    <ul class="nav nav-pills flex-column mb-auto">
                        <li>
                            <p><i class="fa-solid fa-location-pin"></i>
                                @if(!$doctor->medical_address)
                                    <span title="studio non inserito/presente">Studio non presente</span>
                                @else
                                    <span title="indirizzo studio medico"> {{$doctor->medical_address}}</span>
                                @endif
                            </p>
                        </li>
                        <li>
                            <p title="email"><i class="fa-solid fa-envelope"></i> {{$doctor->user->email}}</p>
                        </li>
                        <li>
                            <p><i class="fa-solid fa-phone"></i>
                                @if(!$doctor->phone)
                                    <span title="numero non presente">Telefono non presente</span>
                                @else
                                   <span title="numero telefono">{{$doctor->phone}}</span>
                                @endif
                            </p>
                        </li>
                        <li>
                            <p><i class="fa-solid fa-file"></i>
                                @if(!$doctor->cv)
                                    <span title="nessun cv caricato">Nessun cv</span>
                                @else
                                    <a class="nav-link text-dark text-decoration-underline d-inline" title="guarda il tuo cv" href="{{url('storage/'. Auth::user()->doctor->cv)}}">Guarda Cv</a>
                                @endif
                            </p>
                        </li>
                        <hr>
                        <li>
                            <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" class="delete-profile" data-name="{{$doctor->user->surname}}">
                                @csrf
                                @method('DELETE')

                                <a class="nav-link text-danger" style="cursor:pointer;" title="elimina il tuo profilo"><i class="fa-solid fa-trash-can"></i> Elimina profilo</a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    @endif

@endsection


<style scoped>

    #info{
        box-shadow: 0px 0px 10px 0px rgb(241, 179, 143);
    }
    .nav-link:hover{
        font-weight: bold;
        transition: 0.2s;
    }

</style>
