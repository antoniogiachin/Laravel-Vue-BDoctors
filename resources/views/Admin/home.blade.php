@extends('layouts.app')

@section('content')

@php
    $user = Auth::user();
    $name = $user->name;
    $surname = $user->surname;
    $address = $user->address;
    $email = $user->email;
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
<div class="section bg-primary">
    <div class="container-fluid">
        <div class="row bg-primary text-white py-2 border-bottom">
            {{-- immagine e nome dottore --}}
            <div class="col-4 d-flex">
                {{-- Verifica se la foto è presente --}}
                @if (!$doctor->photo)
                <img src=" {{ asset('img/not_found.jpg') }} " alt="not_found_photo" class="img-fluid py-2 rounded-circle ms_h-100p">
                @else
                    <img src=" {{ asset('storage/' . $doctor->photo) }} " alt="{{ $doctor->id }}_photo" class="img-fluid py-2 rounded-circle ms_h-100p">
                @endif
                {{-- Nome e cognome dottore --}}
                <h4 class="ms-3 d-flex align-items-center">{{$name}} {{$surname}}</h4>
            </div>
            <div class="col d-flex align-items-center ms-5">
                <h3>DashBoard</h3>
            </div>
            <div class="col-2 d-flex align-items-center">
                <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" class="delete-profile" data-name="{{$doctor->user->surname}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger text-white">Elimina Profilo</button>
                </form>
            </div>
        </div>
       <div class="container bg-primary text-center text-white rounded">
           <div class="row mt-2">
                <div class="col-12 border rounded-pill py-3 border-0 ms_hover_border">
                    <h3><a class="text-white nav-link" href="{{ route('admin.doctors.show', $doctor->slug) }}">Vedi Profilo</a></h3>
                </div>
               <div class="col-12 border rounded-pill py-3 py-3 border-0 ms_hover_border">
                   <h3><a class="text-white nav-link" href="{{ route('admin.doctors.edit', $doctor->slug) }}">Modifica Profilo</a></h3>
               </div>
               <div class="col-12 border rounded-pill py-3 border-0 ms_hover_border">
                   <h3><a class="text-white nav-link" href="{{route('admin.leads')}}">Messaggi Ricevuti</a></a></h3>
               </div>
               <div class="col-12 border rounded-pill py-3 border-0 ms_hover_border">
                  <h3>Recensioni</h3>
               </div>
           </div> 
            <div class="col-12 border rounded-pill py-3 border-0 ms_hover_border">
                <h3><a class="text-white nav-link" href="">Sponsor</a></h3>
            </div>
            <div class="col-12 border rounded-pill py-3 border-0 ms_hover_border">
                <h3>Statistiche</h3>
            </div>
         
       </div>
    </div>
</div>

@endsection
