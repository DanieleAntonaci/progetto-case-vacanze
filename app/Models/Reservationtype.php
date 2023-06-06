<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservationtype extends Model
{
    use HasFactory;


    protected $fillable =[
        'tipology'
    ];

    public function reservations(){
        return $this -> hasMany(Reservation::class);
    }
}
