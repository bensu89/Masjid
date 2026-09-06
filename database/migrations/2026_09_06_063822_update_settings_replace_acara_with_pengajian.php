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
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'jadwal_pengajian_enabled')) {
                $table->boolean('jadwal_pengajian_enabled')->default(true)->after('jadwal_shalat_jumat_enabled');
            }
            if (Schema::hasColumn('settings', 'acara_keagamaan_enabled')) {
                $table->dropColumn('acara_keagamaan_enabled');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'acara_keagamaan_enabled')) {
                $table->boolean('acara_keagamaan_enabled')->default(true)->after('jadwal_shalat_jumat_enabled');
            }
            if (Schema::hasColumn('settings', 'jadwal_pengajian_enabled')) {
                $table->dropColumn('jadwal_pengajian_enabled');
            }
        });
    }
};