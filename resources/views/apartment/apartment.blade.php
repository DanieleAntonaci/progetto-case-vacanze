@extends('layouts.app')

@section('content')
<div class="container">
    <h1>
        {{$apartment -> name}}
    </h1>
    <h6>
        ID SRUTTURA: {{$apartment -> id_spot}}
    </h6>
    <div>
        NUMERO PERSONE: {{$apartment -> number_people}}

    </div>
    LETTI MATRIMONIALI: {{$apartment -> double_beds}} <br>
    NUMERO BAGNI: {{$apartment -> number_bathrooms}} <br>
    METRI QUADRATI: {{$apartment -> square_meters}} <br>
    DESCRIZIONE: {{$apartment -> description}} <br>
</div>
@endsection
