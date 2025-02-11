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
        Schema::disableForeignKeyConstraints();
        Schema::create('schedules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_maskapai');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_sampai');
            $table->time('waktu_berangkat');
            $table->time('waktu_sampai');
            $table->string('bandara_asal');
            $table->string('bandara_tujuan');
            $table->integer('kursi_tersedia');
            $table->integer('harga_per_kursi');  
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('schedules');
        Schema::enableForeignKeyConstraints();
    }
};
