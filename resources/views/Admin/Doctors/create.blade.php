@extends('layouts.app')

@section('content')

    <div class="container py-3">
        <h1 class="text-center mb-5">Crea il tuo profilo da dottore</h1>
        <div class="row">
            <div class="col-6 mx-auto">
                {{-- form creazione --}}
                <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

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
                        <textarea name="performance" class="form-control" placeholder="Inserisci le prestazioni che offri" id="performance" rows="10" style="height: 300px">{{ old('performance') }}</textarea>
                        <label for="performance">Prestazioni offerte</label>
                    </div>
                    {{-- cv --}}
                    <div class="mb-3">
                        <label for="cvBlob" class="form-label">Carica il tuo Curriculum Vitae</label>
                        <input name="cvBlob" type="file" class="form-control" id="cvBlob">
                    </div>
                    {{-- foto --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">Carica una tua immagine del profilo</label>
                        <input name="photo" type="file" class="form-control" id="image">
                    </div>

                    {{-- specializzazione --}}
                    <div class="form-check p-0 my-3">
                        <h5 class="my-3">Seleziona le tue specializzazioni</h5>
                        {{-- dinamico --}}
                        @foreach ($specialties as $specialty)
                            {{-- <input name="specialties[]" class="form-check-input" type="checkbox" value="{{ $specialty->id }}" id="specialty_{{ $specialty->id }}">
                            <label class="form-check-label" for="specialty_{{ $specialty->id }}"">
                            {{ $specialty->name }}
                            </label> --}}
                            <div class="form-check">
                                <input {{ in_array($specialty->id, old('specialties', [])) ? 'checked' : '' }} class="form-check-input" type="checkbox" value="{{ $specialty->id }}" id="specialty_{{ $specialty->id }}" name="specialtiesId[]">
                                <label class="form-check-label" for="specialty_{{ $specialty->id }}">
                                    {{ $specialty->name }}
                                </label>
                                </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary">Salva</button>

                </form>
            </div>
        </div>
    </div>



@endsection
