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
        Schema::create('pandemie', function (Blueprint $table) {
            $table->id('id_pandemie');
            $table->string('nom_pandemie', 100);
            $table->string('virus', 100);
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->text('description')->nullable();
            $table->primary('id_pandemie');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pandemie');
    }
};
