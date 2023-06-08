@extends('layouts.app')

@section('content')
<div class="container">
    <h1>
        {{$reservation -> guest}}
    </h1>
    <h2>
        {{$reservation -> telephone_number}}
    </h2>
    <h3>
        {{$reservation -> email}}
    </h3>
    <div>
        Data di arrivo: {{$reservation -> arrival_date}}

    </div>
    <div>
        Data di partenza:
        {{$reservation -> departure_date}}
    </div>
    Prezzo:
    <b>
        {{$reservation -> price}},00 &euro;

    </b>
</div>
@endsection