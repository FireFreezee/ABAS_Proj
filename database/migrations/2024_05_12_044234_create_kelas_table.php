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
        Schema::create('kelas', function (Blueprint $table) {
            $table->increments('id_kelas');

            $table->unsignedInteger('id_jurusan');
            $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusans');

            $table->integer('nomor_kelas')->nullable();
            $table->string('nuptk')->nullable();
            $table->foreign('nuptk')->references('nuptk')->on('wali__kelas')->onUpdate('cascade')->onDelete('set null');
            $table->enum('tingkat', ['10', '11', '12']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
