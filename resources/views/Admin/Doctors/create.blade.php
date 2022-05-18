@extends('layouts.app')

@section('content')

<div class="container col-xxl-8 px-4 py-5">
    <div class="row flex-lg-row-reverse g-5 py-5 justify-content-center">
      <div class="col-10 col-sm-8 col-lg-6">
        {{-- Crezione form --}}
  
        <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- foto --}}
            <div class="mb-3">
                <label for="image" class="form-label">Carica una tua immagine del profilo</label>
                <input name="photo" type="file" class="form-control" id="image">
            </div>
            {{-- cv --}}
            <div class="mb-3">
                <label for="cvBlob" class="form-label">Carica il tuo Curriculum Vitae</label>
                <input name="cvBlob" type="file" class="form-control" id="cvBlob">
            </div>

            {{-- indirizzo studio medico --}}
            <div class="mb-3">
                <label for="medical_address" class="form-label">Inserisci indirizzo studio medico</label>
                <input type="text" class="form-control" id="medical_address" name="medical_address" aria-describedby="emailHelp" value="{{ old('medical_address') }}">
            </div>
            {{-- telefono --}}
            <div class="mb-3">
                <label for="phone" class="form-label">Inserisci il tuo numero di telefono</label>
                <input type="text" class="form-control" id="phone" aria-describedby="emailHelp" name="phone" value="{{ old('phone') }}">
            </div>
            {{-- servizi offerti --}}
            <div class="form-floating mb-3">
                <textarea name="performance" class="form-control" placeholder="Inserisci le prestazioni che offri" id="performance" rows="10">{{ old('performance') }}</textarea>
                <label for="performance">Prestazioni offerte</label>
            </div>

            {{-- specializzazione --}}
            <div class="form-check p-0 my-3">
                <h5 class="my-3">Seleziona le tue specializzazioni*</h5>
                {{-- dinamico --}}
                <div class="d-flex flex-wrap">
                    @foreach ($specialties as $specialty)
                    {{-- <input name="specialties[]" class="form-check-input" type="checkbox" value="{{ $specialty->id }}" id="specialty_{{ $specialty->id }}">
                    <label class="form-check-label" for="specialty_{{ $specialty->id }}"">
                    {{ $specialty->name }}
                    </label> --}}
                    <div class="form-check m-2">
                        <input {{ in_array($specialty->id, old('specialties', [])) ? 'checked' : '' }} class="form-check-input" type="checkbox" value="{{ $specialty->id }}" id="specialty_{{ $specialty->id }}" name="specialtiesId[]">
                        <label class="form-check-label" for="specialty_{{ $specialty->id }}">
                            {{ $specialty->name }}
                        </label>
                    </div>
                @endforeach
                </div>
                

                <input type="text" id="otherSpec" class="form-control mt-4" name="otherSpec" placeholder="Inserisci una specializzazione non presente">
            </div>

            <button type="submit" class="btn btn-primary text-white">Salva</button>

        </form>
        
      </div>
      <div class="col-lg-6">
        <h1 class="fw-bold lh-1 mb-3">Crea il tuo profilo ed entra nella piattaforma BDoctors</h1>
        <p class="lead">Più di 1.5 MLN di dottori e medici iscritti</p>
        <img src="{{asset('img/create.jpg')}}" alt="create_img" height="300px" width="100%">
      </div>
    </div>
  </div>

@endsection


