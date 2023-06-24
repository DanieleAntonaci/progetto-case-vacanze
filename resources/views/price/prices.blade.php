
@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <a class="btn btn-primary w-25" href="{{route('dashboard')}}">Indietro</a>
        <a class="btn btn-primary w-25" href="{{route('createPrice')}}">Aggiungi nuovi prezzi</a>
    </div>    
    <div>

    
    @foreach ($months as $key  => $month)
        <a href="{{route('prices',$key + 1)}}" 

        @if ($key + 1 == $monthSelected)
            class="btn btn-primary"
        @else
            class=" btn btn-outline-primary"
        @endif>{{$month}}</a>

    @endforeach


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

            @foreach ($days as $day)
                <tr>

                    <td>
                        {{$day}}
                    </td>

                    @foreach ($apartmentList as $apartmentPrice)

                        <td>
                            @foreach ($prices as $price)

                                @if ($day == date('d-m-Y', strtotime($price['date'])))
                                    @foreach ($price -> apartments as $apartment)
                                        @if ($apartment -> name == $apartmentPrice)   
                                            <a href="{{route('editPrice', $price)}}" class="text-dark link-offset-2 link-underline link-underline-opacity-0">{{$price -> price}}</a>
                                        @endif
                                    @endforeach
                                        
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