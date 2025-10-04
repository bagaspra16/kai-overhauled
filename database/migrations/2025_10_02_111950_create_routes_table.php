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
        Schema::create('routes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('origin_station_id')->comment('Stasiun asal');
            $table->uuid('destination_station_id')->comment('Stasiun tujuan');
            $table->decimal('base_price', 10, 2)->comment('Harga dasar per orang');
            $table->decimal('infant_price', 10, 2)->default(0.00)->comment('Harga bayi (biasanya 0)');
            $table->integer('distance_km')->nullable()->comment('Jarak dalam kilometer');
            $table->time('estimated_duration')->nullable()->comment('Estimasi durasi perjalanan');
            $table->boolean('is_active')->default(true)->comment('Status aktif rute');
            $table->timestamps();
            
            $table->foreign('origin_station_id')->references('id')->on('stations')->onDelete('cascade');
            $table->foreign('destination_station_id')->references('id')->on('stations')->onDelete('cascade');
            
            $table->unique(['origin_station_id', 'destination_station_id']);
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};