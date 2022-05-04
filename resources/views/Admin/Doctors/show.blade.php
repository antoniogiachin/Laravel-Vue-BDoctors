@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-6">
                <h1 class="h2">Questo è il tuo profilo {{ $doctor->user->name }} - {{ $doctor->user->surname }}</h1>
                <p>Indirizzo: {{ $doctor->user->address }}</p>
                <p>Indirizzo Studio medico: {{ $doctor->medical_address }}</p>
                <p>Telefono: {{ $doctor->phone }}</p>
                <p>Email: {{ $doctor->user->email }}</p>
                <p>Prestazioni eseguite: </p>
                <p>{{ $doctor->performance }}</p>
                <p>Scarica il tuo cv -> <a href="{{ route('admin.downloadCv') }}">Clicca qui</a> </p>
                <p class="mt-3 mb-1">Specializzato in: </p>
                <div class="d-flex gap-3">
                    @foreach ($doctor->specialties as $specialty)
                        <span class="badge rounded-pill bg-info text-dark">{{ $specialty->name }}</span>
                    @endforeach
                </div>
            </div>
            <div class="col-6">
                @if (!$doctor->photo)
                    <img src=" {{ asset('img/not_found.jpg') }} " alt="not_found_photo" class="img-fluid">
                @else
                    <img src=" {{ asset('storage/' . $doctor->photo) }} " alt="{{ $doctor->id }}_photo" class="img-fluid">
                @endif
            </div>
        </div>  
        <div class="row mt-5">
            <div class="col-6">Recensioni ricevute</div>
            <div class="col-6">Contatti ricevuti</div>
        </div>
    </div>
@endsection
