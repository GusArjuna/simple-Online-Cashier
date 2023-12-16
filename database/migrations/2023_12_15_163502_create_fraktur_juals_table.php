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
        Schema::create('fraktur_juals', function (Blueprint $table) {
            $table->id();
            $table->string('kodeMakanan');
            $table->string('kodeMember');
            $table->integer('qty');
            $table->string('harga');
            $table->string('total');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fraktur_juals');
    }
};
