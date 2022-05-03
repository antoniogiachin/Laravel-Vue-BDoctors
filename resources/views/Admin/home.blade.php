@extends('layouts.app')

@section('content')
@if (session('alreadyCreated'))
    <div class="alert alert-danger" role="alert">
        {{ session('alreadyCreated') }}
    </div>
@endif
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
            @if (!$doctor)
                <a href="{{ route('admin.doctors.create') }}" class="btn mt-3 text-white btn-success">Registra il tuo profilo da dottore</a>
            @else
                <div class="d-flex align-items-center justify-content-start gap-3 mt-3">
                    {{-- show --}}
                    <a class="btn text-dark btn-primary" href="{{ route('admin.doctors.show', $doctor->id) }}">Visualizza il tuo profilo da dottore</a>
                    {{-- edit --}}
                    <a class="btn text-dark btn-warning" href="{{ route('admin.doctors.edit', $doctor->id) }}">Modifica il tuo profilo da dottore</a>
                    {{-- delete --}}
                    <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Elimina il tuo profilo da dottore</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
