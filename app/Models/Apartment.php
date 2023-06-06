<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_spot',
        'number_people',
        'num_min_people',
        'num_max_people',
        'double_beds',
        'single_bed',
        'sofa_bed',
        'number_bathrooms',
        'square_meters',
        'visible',
        'description'
    ];

        // SERVICE
        public function services()
        {
            return $this->belongsToMany(Service::class);
        }

        // ricevute
        public function receipts (){
            return $this -> hasMany(Receipt::class);
        }

        // prenotazioni
        public function reservations () {
            return $this -> hasMany(Reservation::class);
        }

        // prezzi
        public function prices (){
            return $this -> belongsToMany(Price::class);
        }

        // struttura
        public function structure(){
            return $this -> belongsTo(Structure::class);
        }

        // image
        public function images (){
            return $this -> hasMany(Image::class);
        }
}
