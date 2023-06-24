@extends('layouts.app')

@section('content')
    <a href="{{route('dashboard')}}" class="btn btn-primary">Indietro</a>

    <div class="d-flex justify-content-between mt-4">
        @foreach ($structures as $structure)
    
            <div class="list-group my_list">

                <h2>{{$structure -> name}} </h2>

                @foreach ($apartments as $apartment)
                    @if ($structure -> name === $apartment -> structure -> name)
                        <a href="{{route('singleApartment', $apartment)}}" class="link-offset-2 link-underline link-underline-opacity-0 list-group-item list-group-item-action list-group-item-action text-center">
                            {{$apartment -> name}}
                        </a>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
@endsection

<style>
    .my_list{
        width:calc(100% / 3)
    }
</style>