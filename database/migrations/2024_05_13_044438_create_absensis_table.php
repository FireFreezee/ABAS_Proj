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

            $table->unsignedInteger('id_koordinat_sekolah')->nullable();
            $table->foreign('id_koordinat_sekolah')->references('id_koordinat_sekolah')->on('koordinat__sekolahs');

            $table->unsignedInteger('id_waktu_absen')->nullable();
            $table->foreign('id_waktu_absen')->references('id_waktu_absen')->on('waktu__absens');

            $table->enum('status', ['Hadir', 'Sakit', 'Izin', 'Tidak Hadir', 'Terlambat'])->default('Tidak Hadir');
            $table->string('photo_in');
            $table->string('photo_out')->nullable();
            $table->string('keterangan')->nullable();
            $table->date('date');
            $table->time('jam_masuk');
            $table->time('jam_pulang')->nullable();
            $table->point('titik_koordinat_masuk');
            $table->point('titik_koordinat_pulang')->nullable();
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
