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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->integer('Nis')->unique();
            $table->string('Nama');
            $table->enum('JenisKelamin', ['Laki-laki', 'Perempuan']);
            $table->date('TanggalLahir');
            $table->string('Alamat');
            $table->unsignedBigInteger('Kota_ID')->nullable();
            $table->foreign('Kota_ID')->references('ID')->on('kota')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
