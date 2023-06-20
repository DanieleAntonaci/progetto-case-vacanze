@extends('layouts.app')

<?php 
    $month = -1;
?>
@section('content')
<div class="container">

    <div>
        <a href="{{route('reservation')}}" class="btn btn-outline-primary">Prenotazioni</a>
    </div>
    <div>
        <a href="{{route('home')}}" class="btn btn-outline-primary">Appartamenti</a>
    </div>
    <div>
        <a href="{{route('prices',$month)}}" class="btn btn-outline-primary">Prezzi giornalieri</a>
    </div>
    <div>
        <a href="{{route('weekPrice',$month)}}" class="btn btn-outline-primary">Prezzi Settimanali</a>
    </div>
</div>
@endsection