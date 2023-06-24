@extends('layouts.app')

@section('content')
    <h1 class="text-center">INSERIMENTO PREZZI SETTIMANALI</h1>
    <a href="{{route('weekPrice')}}" class="btn btn-primary">Indietro</a>

    <form action="{{route('updateWeekPrice')}}" method="post">
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

        <div class="mt-5">

            <input type="date" name="startDate" class="@error('startDate') is-invalid @enderror">
            <label for="startDate">Sabato di inizio</label>
            
            <input type="date" name="endDate" class="@error('endDate') is-invalid @enderror">
            <label for="endDate">Sabato di fine</label>
            
            <input type="number" name="price" class="@error('price') is-invalid @enderror">
            <label for="price">Prezzo</label>
            
        </div>
        <input type="submit" value="Aggiungi i prezzi" class="btn btn-primary mt-3">
    </form>
@endsection