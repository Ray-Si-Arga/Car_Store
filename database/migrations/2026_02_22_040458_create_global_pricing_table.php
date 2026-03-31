<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Table harga
        Schema::create('global_pricing', function (Blueprint $table) {
            $table->id();
            $table->string('nama_event');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('type', ['percentage', 'nominal']);
            $table->integer('value');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global_pricing');
    }
};
