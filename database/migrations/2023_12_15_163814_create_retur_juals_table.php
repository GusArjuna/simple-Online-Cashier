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
        Schema::create('retur_juals', function (Blueprint $table) {
            $table->id();
            $table->string('kodeTransaksi');
            $table->string('kodeMakanan');
            $table->string('kodeMember');
            $table->integer('qty');
            $table->string('harga');
            $table->string('total');
            $table->string('Alasan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retur_juals');
    }
};
