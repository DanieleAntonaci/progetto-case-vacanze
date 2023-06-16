@extends('layouts.app')

<?php 
    $month = -1;
?>
@section('content')
<div class="container">

    <div>
        <a href="{{route('reservation')}}">Prenotazioni</a>
    </div>
    <div>
        <a href="{{route('home')}}">Appartamenti</a>
    </div>
    <div>
        <a href="{{route('prices',$month)}}">Prezzi</a>
    </div>
</div>
@endsection