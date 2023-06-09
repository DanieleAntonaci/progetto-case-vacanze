@extends('layouts.app')

@section('content')

    <a href="{{route('prices', -1)}}" class="btn btn-primary">Indietro</a>
    <a href="{{route('deletePrice', $price)}}" class="btn btn-danger ms-3">Elimina prezzo</a>

    <form action="{{route('updatePrice', $price)}}" method="post">
        @csrf
        @foreach ($structures as $structure)
            <div class="pt-3">

                <h2>{{$structure -> name}}</h2>
                
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    @foreach ($structure -> apartments as $apartment)
                        <input type="checkbox" name="apartmentArray[]" class="btn-check" value="{{$apartment -> id}}" id="{{$apartment -> id}}" 
                        @foreach ($price -> apartments as $item)
                            @if ($item -> name == $apartment -> name)
                            checked
                            @endif
                            @endforeach
                        >
                        <label for="{{$apartment -> id}}"  class="btn btn-outline-primary" >{{$apartment -> name}}</label>
                    @endforeach
                </div>

            </div>
        @endforeach

        <div class="pt-5">

        
        <label for="price">Prezo</label>
        <input type="number" name="price" value="{{$price -> price}}">

        <label for="date_start">Data d'inizio</label>
        <input type="date" name="date_start" value="{{$price -> date}}">

        <label for="date_end">Data di fine</label>
        <input type="date" name="date_end" value="{{$price -> date}}">

        <input type="submit" value="Aggiorna prezzi">
    </div>
    </form>
@endsection

