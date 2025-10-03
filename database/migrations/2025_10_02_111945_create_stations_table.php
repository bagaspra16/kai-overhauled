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
        Schema::create('stations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code', 10)->unique()->comment('Kode stasiun (misal: GMR, SBY)');
            $table->string('name', 100)->comment('Nama stasiun');
            $table->string('city', 100)->comment('Kota lokasi stasiun');
            $table->string('province', 100)->comment('Provinsi lokasi stasiun');
            $table->decimal('latitude', 10, 8)->nullable()->comment('Koordinat latitude');
            $table->decimal('longitude', 11, 8)->nullable()->comment('Koordinat longitude');
            $table->boolean('is_active')->default(true)->comment('Status aktif stasiun');
            $table->timestamps();
            
            $table->index(['city', 'province']);
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stations');
    }
};