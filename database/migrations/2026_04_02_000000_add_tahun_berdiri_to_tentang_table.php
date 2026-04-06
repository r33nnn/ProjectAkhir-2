<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('Tentang', function (Blueprint $table) {
            if (!Schema::hasColumn('Tentang', 'tahun_berdiri')) {
                $table->string('tahun_berdiri')->nullable()->after('misi');
            }
        });
    }

    public function down(): void
    {
        Schema::table('Tentang', function (Blueprint $table) {
            if (Schema::hasColumn('Tentang', 'tahun_berdiri')) {
                $table->dropColumn('tahun_berdiri');
            }
        });
    }
};