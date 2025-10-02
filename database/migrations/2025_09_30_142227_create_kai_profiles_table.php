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
        Schema::create('kai_profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_perusahaan');
            $table->string('slogan');
            $table->text('visi');
            $table->text('misi');
            $table->text('alamat');
            $table->string('email', 100);
            $table->string('telepon', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kai_profiles');
    }
};
