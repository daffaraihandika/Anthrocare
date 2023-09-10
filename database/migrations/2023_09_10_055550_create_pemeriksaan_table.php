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
            $table->unsignedBigInteger('id_infant');
            $table->date('tgl_pemeriksaan');
            $table->double('zscore', 8, 2);
            $table->double('suhu', 8, 2);
            $table->double('berat', 8, 2);
            $table->double('panjang_badan', 8, 2);
            $table->enum('kondisi', ['tinggi', 'normal', 'stunted', 'severely stunted']);
            $table->foreign('id_infant')->references('id')->on('infants');
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
