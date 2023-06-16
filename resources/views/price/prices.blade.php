
@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between mb-4">
        <a class="btn btn-primary w-25" href="{{route('dashboard')}}">Indietro</a>
        <a class="btn btn-primary w-25" href="{{route('priceCreate')}}">Aggiungi nuovi prezzi</a>
    </div>
    


    <table class="table table-light table-striped table-bordered">
        <thead>
            <tr>

                <th>Data</th>
                @foreach ($apartmentList as $apartment)
                    <th>{{$apartment}}</th>
                
                @endforeach
            </tr>
        </thead>


        <tbody>

            @foreach ($objPrices as $price)
                <tr>

                    <td>
                        {{date('d-m-Y', strtotime($price['date']))}}
                    </td>

                    @foreach ($apartmentList as $apartmentPrice)

                        <td>
                            @foreach ($price['assPriceApartment'] as $item)
                                @if (in_array($apartmentPrice,$item['apartments']))
                                    {{$item['price']}}
                                @endif
                            @endforeach
                        </td>

                    @endforeach

                </tr>
            @endforeach
        </tbody>

    </table>

</div>
@endsection