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
        Schema::create('wali__siswas', function (Blueprint $table) {
            $table->string('nik')->primary();

            $table->string('id_user')->nullable();
            $table->foreign('id_user')->references('id_user')->on('users');

            $table->enum('jenis_kelamin', ['laki laki', 'perempuan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wali__siswas');
    }
};
