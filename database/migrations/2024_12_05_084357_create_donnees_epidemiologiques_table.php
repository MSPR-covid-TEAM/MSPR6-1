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
        Schema::create('donnees_epidemiologiques', function (Blueprint $table) {
            $table->id();
            $table->float('taux_transmission');
            $table->float('taux_mortalite');
            $table->integer('infections');
            $table->date('date_observation');
        
            // Clés étrangères
            $table->foreignId('pandemie_id')->constrained('pandemies')->onDelete('cascade');
            $table->foreignId('pays_id')->constrained('pays')->onDelete('cascade');
            $table->foreignId('source_id')->constrained('sources')->onDelete('cascade');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donnees_epidemiologiques');
    }
};
