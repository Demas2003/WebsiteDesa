<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kolom "category" sebelumnya hanya ada di database (migration aslinya
     * hilang), sehingga tidak ikut terbentuk saat migrate:fresh.
     */
    public function up(): void
    {
        if (! Schema::hasColumn('galleries', 'category')) {
            Schema::table('galleries', function (Blueprint $table) {
                $table->string('category')->default('kegiatan')->after('description');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('galleries', 'category')) {
            Schema::table('galleries', function (Blueprint $table) {
                $table->dropColumn('category');
            });
        }
    }
};
