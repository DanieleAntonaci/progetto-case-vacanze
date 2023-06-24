@extends('layouts.app')

@section('content')

    <a href="{{route('prices', -1)}}" class="btn btn-primary">Indietro</a>

    <form action="{{route('priceStore')}}" method="post">
        @csrf
        @foreach ($structures as $structure)
            <div class="pt-3">

                <h2>{{$structure -> name}}</h2>
                
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    @foreach ($structure -> apartments as $apartment)
                        <input type="checkbox" name="apartmentArray[]" class="btn-check" value="{{$apartment -> id}}" id="{{$apartment -> id}}">
                        <label for="{{$apartment -> id}}"  class="btn btn-outline-primary" >{{$apartment -> name}}</label>
                    @endforeach
                </div>

            </div>
        @endforeach

        <div class="pt-5">

        
        <label for="price">Prezo</label>
        <input type="number" name="price">

        <label for="date_start">Data d'inizio</label>
        <input type="date" name="date_start">

        <label for="date_end">Data di fine</label>
        <input type="date" name="date_end">

        <input type="submit" value="Aggiungi">
    </div>
    </form>

@endsection
