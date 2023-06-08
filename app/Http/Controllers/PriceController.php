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
        $prices= Price::with('apartments')-> get();
        return view('price.prices', compact('prices'));
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
