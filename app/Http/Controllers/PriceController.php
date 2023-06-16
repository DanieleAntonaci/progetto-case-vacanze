<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Price;
use App\Models\Structure;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Error;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function showPrice(){

        $prices= Price::orderBy('date', 'asc')-> orderBy('price')->with('apartments')-> get();
        $apartmentList= Apartment::pluck('name')->toArray();

        $objPrices = [];
        $assPriceApartment =[];
        $objPricesIndex=0;
        $apartmentArray =[];
        $newRow = false;
        
        for ($index=0; $index < count($prices); $index++) {
            $samePrice =false;
            $differentPrice =false;
            $positionPrice =0;
            
            if ($newRow) {
                
                for ($i=0; $i < count($objPrices[$objPricesIndex]['assPriceApartment']); $i++) { 

                    $positionPrice = $i;
                    if ($prices[$index]['date'] === $objPrices[$objPricesIndex]['date']) {
                        
                        if($prices[$index]['price'] === $objPrices[$objPricesIndex]['assPriceApartment'][$positionPrice]['price']){
                            // stessa data e stesso prezzo
                            $samePrice =true;
                        }elseif($prices[$index]['price'] !== $objPrices[$objPricesIndex]['assPriceApartment'][$positionPrice]['price']){
                            // stessa data ma prezzo diverso
                            $differentPrice =true;
                        }
                    }
                    
                }
            }


            if($index === 0 ){
                // per il vaolore uguale a 0 non c'é niente da controllare, deve solo crearne una nuova
                $newRow = true;

                // inserisce nell'array i nomi degli appartamenti
                foreach ($prices[$index]['apartments'] as $key => $value) {
                    array_push($apartmentArray,$value['name']);
                }

                // Inserisce nell associatore prezzi-appartamenti
                array_push($assPriceApartment, [
                    'price' => $prices[$index]['price'],
                    'apartments' => $apartmentArray
                ]);

                // crea il nuovo elemnto dell'array
                $objPrices[$objPricesIndex] =[
                    'date' => $prices[$index]['date'], 
                    'assPriceApartment'=>$assPriceApartment,
                ];

            }elseif($samePrice){

                $samePrice= false;

                // inserisce nell'array i nomi degli appartamenti
                foreach ($prices[$index]['apartments'] as $key => $value) {
                    array_push($apartmentArray,$value['name']);
                }

                // potrebbero esserci piú prezzi associati
                $objPrices[$objPricesIndex]['assPriceApartment'][$positionPrice] =[
                    'price' => $objPrices[$objPricesIndex]['assPriceApartment'][$positionPrice]['price'],
                    'apartments' => $apartmentArray,
                ];

               

            }elseif($differentPrice){

                $apartmentArray =[];
                $differentPrice = false;

                foreach ($prices[$index]['apartments'] as $key => $value) {
                    array_push($apartmentArray,$value['name']);
                }

                array_push($assPriceApartment, [
                    'price' => $prices[$index]['price'],
                    'apartments' => $apartmentArray
                ]);

                $objPrices[$objPricesIndex] =[
                    'date' => $objPrices[$objPricesIndex]['date'], 
                    'assPriceApartment'=>$assPriceApartment,
                ];

            }else{

                $objPricesIndex = $objPricesIndex + 1;
                $apartmentArray =[];
                $assPriceApartment =[];

                foreach ($prices[$index]['apartments'] as $key => $value) {
                    array_push($apartmentArray,$value['name']);
                }

                array_push($assPriceApartment, [
                    'price' => $prices[$index]['price'],
                    'apartments' => $apartmentArray
                ]);

                $objPrices[$objPricesIndex] =[
                    'date' => $prices[$index]['date'], 
                    'assPriceApartment'=>$assPriceApartment,
                ];
            }
        }

        // var_dump($objPrices);
        return view('price.prices', compact([
            'apartmentList',
            'objPrices'
            ]));
    }

    // reinderizza alla pagina di creazione
    public function createPrice(){
        $structures = Structure::with('apartments') -> get();
        return view('price.priceCreate', compact('structures'));
    }
  
    // memorizza i dati
    public function storePrice(Request $request){
        $data = $request -> validate([
            'price' => 'required|integer|',
            'date_start' => 'required|date_format:"Y-m-d"',
            'date_end' => 'required|date_format:"Y-m-d"|after:'.'date_start',
            'apartmentArray' => 'array|required'
        ]);

        // crea un intervallo di date
        $begin = new DateTime($data['date_start']);
        $end = new DateTime($data['date_end']);
        
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);

        // aggiunge per ogni giorno i prezzi
        foreach ($period as $day) {

            // var_dump($data['apartmentArray']);
            $date = Carbon::parse($day) -> format('Y-m-d');
            // var_dump($date);

            $price= new Price();
            $price -> price = $data['price'];
            $price -> date = $date;
            $apartmentArray = $data['apartmentArray'];

            // controlla se i prezzi sono giá stati inseriti
            $correspondingValue = Price::where('date', $date)
                ->whereHas('apartments', function($query) use ($apartmentArray){
                    $query-> whereIn('apartment_id',$apartmentArray);
                })
                -> exists();

                // se non sono inseriti li aggiunge
            if(!$correspondingValue){

                $price -> save();
                
                foreach ($apartmentArray as $apartmentId) {
                    $apartment = Apartment::find($apartmentId);
                    $price -> apartments() -> attach($apartment);
                }
            }else{
                // oppure crea un eccezione per quella data
                throw new \Exception("Attenzione il prezzo per la data ". $date. " per quell'appartamento é stato giá inserito");
            }
        }
        // ritorna alla funzione di aggiunta
        return $this->createPrice();
    }
}
