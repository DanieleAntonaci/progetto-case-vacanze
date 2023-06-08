<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function showReservation(){
        $reservations = Reservation::all();
        return view('reservation.reservations', compact('reservations'));
    }

    public function reservatoionSingle(Reservation $reservation){
        return view('reservation.reservation', compact('reservation'));
    }
}
