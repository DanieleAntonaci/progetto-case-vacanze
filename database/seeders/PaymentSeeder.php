<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Paymenttype;
use App\Models\Receipt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::factory()-> count(20) -> make()->each(function($payment){
            $receipt = Receipt::inRandomOrder() -> first();
            $paymentType = Paymenttype::inRandomOrder() -> first();
            $payment -> receipt() -> associate($receipt);
            $payment -> paymenttype() -> associate($paymentType);
            $payment -> save();
        });
    }
}
