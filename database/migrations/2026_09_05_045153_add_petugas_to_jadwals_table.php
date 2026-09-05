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
        Schema::table('jadwals', function (Blueprint $table) {
            $table->foreignId('imam_id')->nullable()->constrained('petugas_jumat');
            $table->foreignId('bilal_id')->nullable()->constrained('petugas_jumat');
        });
    }

    public function down(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->dropForeign(['imam_id']);
            $table->dropForeign(['bilal_id']);
            $table->dropColumn(['imam_id', 'bilal_id']);
        });
    }
};
