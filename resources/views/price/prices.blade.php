
@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('priceCreate')}}">Aggiungi nuovi prezzi</a>

    @foreach ($prices as $price)
    {{$price -> price}}
    {{$price}}        
    @endforeach

</div>
@endsection