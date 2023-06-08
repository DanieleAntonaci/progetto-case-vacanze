@extends('layouts.app')

@section('content')

<div class="container">

    <table>
        <thead>
            <tr>

                <th>Nome</th>
                <th>Data di arivo</th>
                <th>Data di patenza</th>
                <th>Prezzo</th>
                <th>Numero di telefono</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($reservations as $reservation)
                <tr>
                    <td>
                        <a href="{{route('reservationShow', $reservation)}}">
                            {{$reservation -> guest}}
                        </a>
                    </td>
                    <td>{{$reservation -> arrival_date}}</td>
                    <td>{{$reservation -> departure_date}}</td>
                    <td>{{$reservation -> price}},00 &euro;</td>
                    <td>{{$reservation -> telephone_number}}</td>
                    <td>{{$reservation -> email}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection