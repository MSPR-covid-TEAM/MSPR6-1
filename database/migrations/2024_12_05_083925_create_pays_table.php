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
        Schema::create('pays', function (Blueprint $table) {
            $table->id('id_pays');
            $table->string('nom_pays', 100);
            $table->char('code_iso', 3);
            $table->integer('population')->nullable();
            $table->integer('dimension')->nullable();
            $table->unique('code_iso');
            $table->primary('id_pays');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pays');
    }
};
