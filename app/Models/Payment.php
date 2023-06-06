<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable =[
        'amount',
        'collection_date'
    ];

    public function receipt (){
        return $this -> belongsTo(Receipt::class);
    }
    public function paymenttype (){
        return $this -> belongsTo(Paymenttype::class);
    }
}
