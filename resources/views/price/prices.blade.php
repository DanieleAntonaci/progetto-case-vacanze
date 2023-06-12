
@extends('layouts.app')

@section('content')
<div class="container">
    <a class="btn btn-primary" href="{{route('priceCreate')}}">Aggiungi nuovi prezzi</a>
    <br>
    <table class="table table-light table-striped">
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
                    {{$price['date']}}
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