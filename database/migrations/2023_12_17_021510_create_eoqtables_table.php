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
        Schema::create('eoqtables', function (Blueprint $table) {
            $table->id();
            $table->string('kodeMakanan');
            $table->float('biayaPenyimpanan');
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
        Schema::dropIfExists('eoqtables');
    }
};
