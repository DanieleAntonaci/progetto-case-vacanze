@extends('layouts.app')

<?php 
    $month = -1;
?>
@section('content')

    <div>
        <h2>Prenotazioni</h2>
        <a href="{{route('reservation')}}" class="btn btn-outline-primary">Prenotazioni</a>
    </div>
    <div>
        <h2>Appartamenti</h2>

        <a href="{{route('home')}}" class="btn btn-outline-primary">Appartamenti</a>
    </div>
    <div>
        <h2>Prezzi</h2>

        <a href="{{route('prices',$month)}}" class="btn btn-outline-primary">Prezzi giornalieri</a>

        <a href="{{route('weekPrice',$month)}}" class="btn btn-outline-primary">Prezzi Settimanali</a>
    </div>

@endsection