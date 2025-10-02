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
        Schema::create('kai_about', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('tahun', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kai_about');
    }
};
