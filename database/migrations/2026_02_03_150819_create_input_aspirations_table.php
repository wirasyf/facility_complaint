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
        Schema::create('input_aspirations', function (Blueprint $table) {
            $table->id();
            $table->integer('nis');
            $table->foreign('nis')->references('nis')->on('users');
            $table->foreignId('id_kategori')->constrained('categories');
            $table->string('lokasi', 50);
            $table->string('ket',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_aspirations');
    }
};
