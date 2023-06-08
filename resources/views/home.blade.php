@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($apartments as $apartment)
    <a href="{{route('singleApartment', $apartment)}}">
        <div>
            <h1>
                {{$apartment -> name}}
            </h1>
            {{$apartment -> structure -> name}}
        </div>
    </a>
    @endforeach
</div>
@endsection
