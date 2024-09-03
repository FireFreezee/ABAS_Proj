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
        Schema::create('absensis', function (Blueprint $table) {
            $table->increments('id_absensi');

            $table->string('nis');
            $table->foreign('nis')->references('nis')->on('siswas');
            $table->enum('status', ['Hadir', 'Sakit', 'Izin', 'Alfa', 'Terlambat', 'TAP'])->default('Alfa');
            $table->string('photo_in')->nullable();
            $table->string('photo_out')->nullable();
            $table->string('keterangan')->nullable();
            $table->date('date')->nullable();
            $table->time('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->string('titik_koordinat_masuk')->nullable();
            $table->string('titik_koordinat_pulang')->nullable();
            $table->integer('menit_keterlambatan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
