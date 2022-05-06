@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center py-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white text-center text-uppercase">{{ __('Registra il tuo profilo') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                            <div class="col-6">
                                {{-- nome --}}
                                <div class="mb-3 ">
                                    <div>
                                        <label for="name" class="form-label">{{ __('Nome *') }}</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                {{-- cognome --}}
                                <div>
                                    <div class="">
                                        <label for="surname" class="form-label">{{ __('Cognome *') }}</label>
                                        <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>
                                        @error('surname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                {{-- indirizzo --}}
                                <div class="mb-3">
                                    <div>
                                        <label for="address" class="form-label">{{ __('Indirizzo *') }}</label>
                                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                {{-- email --}}
                                <div class="mb-3">
                                    <div>
                                        <label for="email" class="form-label">{{ __('Indirizzo e-mail *') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                          {{-- specializzazione --}}
                          <div class="col-6">
                                <div class="mb-3">
                                    <div>
                                        <label for="specialty" class="form-label">{{ __('Specializzazione *') }}</label>                                        
                                        <select id="specialty" class="form-select @error('specialties') is-invalid @enderror" name="specialty_id" required>
                                          <option value="" class="text-muted">Seleziona una specializzazione</option>
                                          @foreach ($specialties as $specialty)
                                            <option value=" {{$specialty->id}} "> {{$specialty->name}} </option>
                                          @endforeach
                                        </select>
                                        
                                        @error('specialties')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            {{-- password --}}
                            <div class="mb-3">
                                <div>
                                    <label for="password" class="form-label">{{ __('Password *') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- password --}}
                            <div class="mb-3">
                                <div>

                                    <label for="password-confirm" class="form-label">{{ __('Conferma Password*') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" onkeyup="checkPass()">
                                    <span id="message"></span>

                                </div>
                            </div>
                        </div>

                        <p class="text-muted fs-6">* campo richiesto</p>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrati') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{asset('js/check-password.js')}}"></script>
@endsection