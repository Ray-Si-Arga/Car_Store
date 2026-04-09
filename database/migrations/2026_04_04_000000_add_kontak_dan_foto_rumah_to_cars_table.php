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
        Schema::table('users', function (Blueprint $table) {

            // tambah kolom satu per satu
            $table->string('nama_orang_terdekat')->after('avatar');
            $table->text('alamat_orang_terdekat')->after('nama_orang_terdekat');
            $table->string('no_telepon_terdekat')->after('alamat_orang_terdekat');
            $table->string('foto_rumah')->nullable()->after('no_telepon_terdekat');
            $table->string('ktp')->after('foto_rumah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // hapus kolom satu per satu
            $table->dropColumn('nama_orang_terdekat');
            $table->dropColumn('alamat_orang_terdekat');
            $table->dropColumn('no_telepon_terdekat');
            $table->dropColumn('foto_rumah');
            $table->dropColumn('ktp');

        });
    }
};
