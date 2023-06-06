<?php

use App\Models\Paymenttype;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paymenttypes', function (Blueprint $table) {
            $table->id();
            $table -> string('type');
            $table->timestamps();
        });

        $services= [            
            'Carta di credito',
            'Contanti',
            'Bonifico',
             'Assegno'
        ];

        // create new service from array(services)
        foreach($services as $service){
            $newPaymentType = new Paymenttype();

            $newPaymentType -> type = $service;

            $newPaymentType -> save();
        };
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paymenttypes');
    }
};
