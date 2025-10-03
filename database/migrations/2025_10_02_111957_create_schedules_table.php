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
        Schema::create('schedules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('route_id')->comment('ID rute perjalanan');
            $table->string('train_name', 100)->comment('Nama kereta');
            $table->string('train_class', 50)->comment('Kelas kereta (Eksekutif, Bisnis, Ekonomi)');
            $table->date('departure_date')->comment('Tanggal keberangkatan');
            $table->time('departure_time')->comment('Waktu keberangkatan');
            $table->time('arrival_time')->comment('Waktu kedatangan');
            $table->integer('total_seats')->comment('Total kursi tersedia');
            $table->integer('available_seats')->comment('Kursi yang masih tersedia');
            $table->decimal('price_modifier', 5, 2)->default(1.00)->comment('Faktor pengali harga (misal peak season 1.2x)');
            $table->boolean('is_active')->default(true)->comment('Status aktif jadwal');
            $table->timestamps();
            
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
            
            $table->index(['departure_date', 'is_active']);
            $table->index(['route_id', 'departure_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};