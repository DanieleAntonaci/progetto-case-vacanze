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

use function PHPUnit\Framework\isNull;

class PriceController extends Controller
{
    public function showPrice(Request $request){
        setlocale(LC_TIME, 'it_IT'); // Imposta la lingua italiana

        $monthSelected = $request['month'];
  

        $currentYear= Carbon::parse(now())->format('Y');

        // SE ARRIVA UN MESE DIVERSO DA I 12 MESI MI PORTA IL MESE CORRENTE
        if($monthSelected === '-1' || $monthSelected === '0' || $monthSelected.isNull()){
            $monthSelected= Carbon::parse(now())->format('m');
        }
        
        $prices= Price::whereYear('date', $currentYear)
            ->whereMonth('date', intval($monthSelected))
            ->orderBy('date', 'asc')
            ->orderBy('price')
            ->with(['apartments' => function ($query) {
                $query->select('name');
            }])
            -> get();

        $apartmentList= Apartment::pluck('name')
            ->toArray();

        //OTTENGO I MESI
        $months = [];
        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::create($currentYear, $month, 1);
            $monthName = $date->formatLocalized('%B');
            $months[] = $monthName;
        }

        // OTTENGO I GIORNI
        $days =[]; 
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $monthSelected, $currentYear);
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = sprintf('%02d-%02d-%04d', $day, $monthSelected, $currentYear);
            $days[] = $date;
        }



        return view('price.prices', compact([
            'apartmentList',
            'prices',
            'months',
            'monthSelected',
            'days'
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


            $date = Carbon::parse($day) -> format('Y-m-d');


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

    public function editPrice(Price $price){
        $structures = Structure::with('apartments') -> get();
        return view('price.priceEdit',compact('structures', 'price'));
    }

    public function updatePrice(Price $price, Request $request){
        $data = $request -> validate([
            'price' => 'required|integer|',
            'date_start' => 'required|date_format:"Y-m-d"',
            'date_end' => 'required|date_format:"Y-m-d"|after:'.'date_start',
            'apartmentArray' => 'array|required'
        ]);

        $begin = new DateTime($data['date_start']);
        $end = new DateTime($data['date_end']);
        
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);

        // aggiunge per ogni giorno i prezzi
        foreach ($period as $day) {
            
            $date = Carbon::parse($day) -> format('Y-m-d');
            
            $price -> price = $data['price'];
            $price -> date = $date;
            $apartmentArray[] = $data['apartmentArray'];
            $price -> save();

            
            foreach ($apartmentArray as $apartmentId) {
                $apartment = Apartment::find($apartmentId);
                $price->apartments()->sync($apartmentId);
            }

        }

        return redirect()-> route('prices',-1);
    }
}
