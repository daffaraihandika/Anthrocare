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
        Schema::create('infants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id');
            $table->string('nama_bayi');
            $table->date('tgl_lahir_bayi');
            $table->enum('jenis_kelamin', ['Laki - Laki', 'Perempuan']);
            $table->string('no_akte_bayi')->unique();
            $table->double('tinggi_lahir', 8, 2);
            $table->double('berat_lahir', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infants');
    }
};
