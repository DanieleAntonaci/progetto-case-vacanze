<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable =[
        'price',
        'start_date',
        'end_date'
    ];

    public function apartments (){
        return $this -> belongsToMany(Apartment::class);
    }
}