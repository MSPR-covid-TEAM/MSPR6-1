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
        Schema::create('stat_pandemie', function (Blueprint $table) {
            $table->id('id_stat');
            $table->unsignedBigInteger('id_pandemie');
            $table->unsignedBigInteger('id_pays');
            $table->date('date');
            $table->integer('nouveaux_cas')->nullable();
            $table->integer('nouveaux_deces')->nullable();
            $table->integer('nouveaux_gueris')->nullable();
            $table->integer('cas_actifs')->nullable();
            $table->primary('id_stat');

            // Clé étrangère 
            $table->foreign('id_pays')->references('id_pays')->on('pays');
            $table->foreign('id_pandemie')->references('id_pandemie')->on('pandemie');

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
