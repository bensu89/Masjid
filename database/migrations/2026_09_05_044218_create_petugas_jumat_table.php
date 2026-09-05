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
        Schema::create('petugas_jumat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_petugas', 150);
            $table->enum('peran_utama', ['Khatib', 'Imam', 'Bilal']);
            $table->string('no_whatsapp', 20);
            $table->text('domisili')->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petugas_jumat');
    }
};
