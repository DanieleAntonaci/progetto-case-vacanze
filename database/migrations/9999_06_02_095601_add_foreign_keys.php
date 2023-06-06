<?php

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
        // RECIPT FOREIGN
        Schema::table('receipts', function(Blueprint $table){
            $table->foreignId('apartment_id') -> constrained();
        });

        // PAYMENT FOREIGN
        Schema::table('payments', function(Blueprint $table){
            $table->foreignId('receipt_id') -> constrained();
            $table->foreignId('paymenttype_id') -> constrained();
        });
        // STRUCTURE FOREIGN
        Schema::table('apartments', function(Blueprint $table){
            $table->foreignId('structure_id') -> constrained();
        });
        // IMAGE FOREIGN
        Schema::table('images', function(Blueprint $table){
            $table->foreignId('apartment_id') -> constrained();
        });
        
        // RESERVATION FOREIGN
        Schema::table('reservations', function(Blueprint $table){
            $table->foreignId('apartment_id') -> constrained();

        });
        //APARTMENT_SERVICE FOREIGN
        Schema::table('apartment_service', function (Blueprint $table) {
            $table->foreignId('apartment_id')
                ->constrained();
            $table->foreignId('service_id')
                ->constrained();
        });
        //APARTMENT_PRICE FOREIGN
        Schema::table('apartment_price', function (Blueprint $table) {
            $table->foreignId('apartment_id')
                ->constrained();
            $table->foreignId('price_id')
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //RECIPT FOREIGN
        Schema::table('receipts', function (Blueprint $table) {
            $table->dropForeign('receipts_apartment_id_foreign');
        });

        //PAYMENT FOREIGN
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign('payments_receipt_id_foreign');
            $table->dropForeign('payments_paymenttype_id_foreign');
        });
        //STRUCTURE FOREIGN
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropForeign('apartments_structure_id_foreign');
        });
        //IMAGE FOREIGN
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign('images_apartment_id_foreign');
        });
        //RESERVATION FOREIGN
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign('reservations_apartment_id_foreign');
        });
 
        //APARTMENT_SERVICE FOREIGN
        Schema::table('apartment_service', function (Blueprint $table) {
            $table->dropForeign('apartment_service_apartment_id_foreign');
            $table->dropForeign('apartment_service_service_id_foreign');
        });
        //APARTMENT_PRICE FOREIGN
        Schema::table('apartment_price', function (Blueprint $table) {
            $table->dropForeign('apartment_price_apartment_id_foreign');
            $table->dropForeign('apartment_price_price_id_foreign');
        });
    }
};
