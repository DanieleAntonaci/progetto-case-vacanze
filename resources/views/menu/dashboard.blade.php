@extends('layouts.app')

@section('content')
<div class="container">

    <div>
        <a href="{{route('reservation')}}">Prenotazioni</a>
    </div>
    <div>
        <a href="{{route('home')}}">Appartamenti</a>
    </div>
    <div>
        <a href="{{route('prices')}}">Prezzi</a>
    </div>
</div>
@endsection