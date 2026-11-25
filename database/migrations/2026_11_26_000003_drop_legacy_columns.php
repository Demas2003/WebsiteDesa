<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kolom duplikat dari skema lama. Aplikasi sekarang memakai
     * status/order (services), status (galleries), dan status (news).
     */
    public function up(): void
    {
        $galleryColumns = array_values(array_filter(
            ['is_active', 'sort_order'],
            fn ($column) => Schema::hasColumn('galleries', $column)
        ));

        if ($galleryColumns) {
            Schema::table('galleries', function (Blueprint $table) use ($galleryColumns) {
                $table->dropColumn($galleryColumns);
            });
        }

        $serviceColumns = array_values(array_filter(
            ['is_active', 'sort_order'],
            fn ($column) => Schema::hasColumn('services', $column)
        ));

        if ($serviceColumns) {
            Schema::table('services', function (Blueprint $table) use ($serviceColumns) {
                $table->dropColumn($serviceColumns);
            });
        }

        if (Schema::hasColumn('news', 'is_published')) {
            Schema::table('news', function (Blueprint $table) {
                $table->dropColumn('is_published');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasColumn('galleries', 'is_active')) {
            Schema::table('galleries', function (Blueprint $table) {
                $table->boolean('is_active')->default(true);
            });
        }

        if (! Schema::hasColumn('galleries', 'sort_order')) {
            Schema::table('galleries', function (Blueprint $table) {
                $table->integer('sort_order')->default(0);
            });
        }

        if (! Schema::hasColumn('services', 'is_active')) {
            Schema::table('services', function (Blueprint $table) {
                $table->boolean('is_active')->default(true);
            });
        }

        if (! Schema::hasColumn('services', 'sort_order')) {
            Schema::table('services', function (Blueprint $table) {
                $table->integer('sort_order')->default(0);
            });
        }

        if (! Schema::hasColumn('news', 'is_published')) {
            Schema::table('news', function (Blueprint $table) {
                $table->boolean('is_published')->default(true);
            });
        }
    }
};
