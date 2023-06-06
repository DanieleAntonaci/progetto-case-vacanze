<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'address',
        'img',
        'distance_center',
        'distance_sea',
        'vibility'
    ];

    public function apartments(){
        return $this -> hasMany(Apartment::class);
    }
}
