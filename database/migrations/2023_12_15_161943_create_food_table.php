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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama');
            $table->string('kelompok');
            $table->integer('qty');
            $table->integer('qtyMinimum');
            $table->integer('hargaBeli');
            $table->integer('hargaJual');
            $table->integer('kebutuhan');
            $table->integer('biayaPemesanan');
            $table->integer('biayaPenyimpanan');
            $table->integer('waktu');
            $table->float('EOQ');
            $table->float('ROP');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
