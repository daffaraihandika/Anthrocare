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
        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_infant')->nullable();
            $table->date('tgl_pemeriksaan')->nullable();
            $table->double('zscore', 8, 2);
            $table->double('suhu', 8, 2);
            $table->double('berat', 8, 2);
            $table->double('panjang_badan', 8, 2);
            $table->enum('kondisi', ['tinggi', 'normal', 'stunted', 'severely stunted'])->nullable();
            $table->foreign('id_infant')->references('id')->on('infants')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
