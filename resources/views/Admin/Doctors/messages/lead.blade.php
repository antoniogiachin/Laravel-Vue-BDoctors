@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col">
                 @foreach ($leads as $lead)
                    <div>{{$lead->author}}</div>
                    <div>{{$lead->email}}</div>
                    <div>{{$lead->message}}</div>
                @endforeach 
            </div>
        </div>
    </div>

@endsection