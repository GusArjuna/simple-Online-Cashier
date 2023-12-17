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
            $table->string('foodCategory');
            $table->integer('qty');
            $table->integer('safetyStock');
            $table->integer('hargaBeli');
            $table->integer('hargaJual');
            $table->integer('biayaPemesanan');
            $table->integer('lifeTime');
            $table->string('keterangan');
            $table->string('penjualan')->nullable();
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
