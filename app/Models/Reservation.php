<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable =[
        'guest',
        'telephone_number',
        'email',
        'arrival_date',
        'departure_date',
        'booking_date',
        'price',
        'linen',
        'price_linen',
        'num_reservation',
    ];

    public function reservationtype (){
        return $this -> belongsTo(Reservationtype::class);
    }

    public function apartment (){
        return $this -> belongsTo(Apartment::class);
    }
}
