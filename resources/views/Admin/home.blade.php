@extends('layouts.app')

@section('content')
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
<div class="container mt-4">
    <div class="row justify-content-center">
        <div>
            <div class="row">
                <div class="col-12">
                    <p class="text-center text-uppercase h4">Dashboard</p>
                </div>

                <div class="col-12">
                    <div class="row">
                        @if (!$doctor)
                            <p class="text-center mt-3">Completa subito il tuo profilo!</p>
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
                        @else
                            <div class="col-4 p-3">
                                <p>Bentornato signor {{ $doctor->user->name }}  {{ $doctor->user->surname }}</p>
                            </div>
                            <div class="col-8 d-flex align-items-center justify-content-start gap-2">
                                {{-- show --}}
                                <a class="btn text-dark btn-primary" href="{{ route('admin.doctors.show', $doctor->id) }}">Visualizza il tuo profilo da dottore</a>
                                {{-- edit --}}
                                <a class="btn text-dark btn-warning" href="{{ route('admin.doctors.edit', $doctor->id) }}">Modifica il tuo profilo da dottore</a>
                                {{-- delete --}}
                                <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" class="delete-profile" data-name="{{$doctor->user->surname}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Elimina il tuo profilo da dottore</button>
                                </form>
                            </div>
                        @endif

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection


