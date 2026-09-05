<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->dropForeign(['khatib_id']);
            $table->foreign('khatib_id')->references('id')->on('petugas_jumat');
        });
    }

    public function down(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->dropForeign(['khatib_id']);
            $table->foreign('khatib_id')->references('id')->on('khatib');
        });
    }
};
