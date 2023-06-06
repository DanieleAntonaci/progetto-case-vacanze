<?php


use App\Models\Reservationtype;
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
        Schema::create('reservationtypes', function (Blueprint $table) {
            $table->id();
            $table->string('tipology', 32);
            $table->timestamps();
        });
        $tipologies= [            
            'Wi-Fi',            
            'Parcheggio gratuito',            
            'Piscina',            
            'Giardino',            
            'Terrazza',            
            'Colazione',            
            'Servizi spa',            
            'Solarium',            
            'Palestra',            
            'Caminetto',            
            'Servizi di pulizia',            
            'Riscaldamento',            
            'Aria condizionata',            
            'Cassaforte',            
            'Cucina',            
            'Divano letto',            
            'Tv',            
            'Vasca idromassaggio',            
            'Asciugacapelli',            
            'Frigorifero',            
            'Lavatrice',            
            'Asciugatrice',
        ];

        // create new service from array(services)
        foreach($tipologies as $tipology){
            $newService = new Reservationtype();

            $newService -> tipology = $tipology;

            $newService -> save();
        };
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservationtypes');
    }
};
