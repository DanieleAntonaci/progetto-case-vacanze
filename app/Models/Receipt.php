<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    // RICEVUTA
    protected $fillable =[
        'number',
        'type',
        'description',
        'tax',
        'people',
        'date'
    ];

    public function apartment (){
        return $this -> belongsTo(Apartment::class);
    }

    public function payments (){
        return $this -> hasMany(Payment::class);
    }
}
