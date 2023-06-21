@extends('layouts.app')

@section('content')
    <h1 class="text-center">Prezzi settimanali</h1>

    <div class="d-flex justify-content-between mb-4">
        <a class="btn btn-primary w-25" href="{{route('dashboard')}}">Indietro</a>
        <a class="btn btn-primary w-25" href="{{route('weekPriceCreate')}}">Aggiungi nuovi prezzi</a>
    </div>    



    <table class="table table-light table-striped table-bordered">
        <thead>
            <tr>
                <th class="my_date sticky-column">Data</th>
                @foreach ($apartmentList as $apartment)
                    <th>
                        {{$apartment}}
                    </th>
                @endforeach

            </tr>
        </thead>

        
        <tbody>
            @foreach ($saturdays as $key => $saturday)
                <tr>
                    <td class="my_date sticky-column">
                        {{ date('d/m', strtotime($saturday)) }}
                        ->
                        @if (count($saturdays) === $key + 1)
                            {{ date('d/m', strtotime($saturday . '+7 days')) }}
                        @else
                            {{ date('d/m', strtotime($saturdays[$key + 1])) }}
                        @endif
                    </td>
        
                    @foreach ($apartmentList as $apartment)
                        <td>
                            @foreach ($results as $result)
                                @if ($result['weekStartDate'] === $saturday)
                                    @foreach ($result['weeklyPrice'] as $apartmentName => $price)
                                        @if ($apartment === $apartmentName)
                                            {{ $price }}
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
@endsection

<style>
    .my_date{
        min-width: 120px
    }
    .sticky-column {
  position: sticky;
  left: 0;
  z-index: 1;
  background-color: #f9f9f9;
}

</style>