@extends('layouts.app')

@section('content')

        <h1 class="text-center">Modifica prezzi settimanali</h1>
        <a href="{{route('weekPrice')}}" class="btn btn-primary">Indietro</a>
        <form action="{{route('weeklyUpdate',['weeklyPrice', 'weekStartDate', 'weekEndDate', 'apartmentName'])}}" method="post">
            @csrf
            @foreach ($structures as $structure)
                <div class="pt-3">

                    <h2>{{$structure -> name}}</h2>
                    
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        @foreach ($structure -> apartments as $apartment)
                            <input type="checkbox" name="apartmentArray[]" class="btn-check" value="{{$apartment -> id}}" id="{{$apartment -> id}}" 
                            {{-- @foreach ($price -> apartments as $item) --}}
                                @if ($apartment -> name == $apartmentName)
                                checked
                                @endif
                                {{-- @endforeach --}}
                            >
                            <label for="{{$apartment -> id}}"  class="btn btn-outline-primary" >{{$apartment -> name}}</label>
                        @endforeach
                    </div>

                </div>
            @endforeach
            <div class="pt-5">    
                <label for="weeklyPrice">Prezzo</label>
                <input type="number" name="weeklyPrice" value="{{$weeklyPrice}}">
                
                <label for="weeklyPrice">Sabato di arrivo</label>
                <input type="date" name="weeklyPrice" value="{{$weeklyPrice}}">
                
                <label for="weeklyPrice">Sabato di partenza</label>
                <input type="date" name="weeklyPrice" value="{{$weeklyPrice}}">

                <input type="submit" value="Modifica">
            </div>
        </form>

@endsection