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
        Schema::create('price_queries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('user_id')->nullable()->comment('ID user jika login');
            $table->uuid('origin_station_id')->comment('Stasiun asal');
            $table->uuid('destination_station_id')->comment('Stasiun tujuan');
            $table->date('departure_date')->comment('Tanggal keberangkatan');
            $table->integer('passenger_count')->comment('Jumlah penumpang dewasa');
            $table->integer('infant_count')->default(0)->comment('Jumlah bayi');
            $table->string('ip_address', 45)->nullable()->comment('IP address user');
            $table->text('user_agent')->nullable()->comment('User agent browser');
            $table->timestamps();
            
            $table->foreign('origin_station_id')->references('id')->on('stations')->onDelete('cascade');
            $table->foreign('destination_station_id')->references('id')->on('stations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            
            $table->index(['departure_date', 'created_at']);
            $table->index(['origin_station_id', 'destination_station_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_queries');
    }
};