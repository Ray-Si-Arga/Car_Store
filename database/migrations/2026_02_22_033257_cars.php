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
        // membuat table cars
        Schema::create('cars', function (Blueprint $table){
            $table->id();
            $table->string('nama_mobil');
            $table->enum('kasta', ['Economy', 'Family', 'Luxury']);
            $table->integer('harga_biasa');
            $table->integer('harga_weekend')->nullable();
            $table->enum('status', ['Tersedia', 'Disewa', 'Perbaikan'])->default('Tersedia');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('cars');
    }
};
