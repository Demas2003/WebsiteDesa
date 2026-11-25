<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel lama bernama "potential" (singular) dan dibuat manual.
     * Migration ini membuat tabel "potentials" sesuai konvensi Laravel
     * sekaligus memindahkan data lama bila ada.
     */
    public function up(): void
    {
        if (! Schema::hasTable('potentials')) {
            Schema::create('potentials', function (Blueprint $table) {
                $table->id();
                $table->string('image');
                $table->string('title');
                $table->text('content');
                $table->text('map_url')->nullable();
            });
        }

        if (Schema::hasTable('potential')) {
            if (DB::table('potentials')->count() === 0) {
                DB::statement(
                    'INSERT INTO potentials (id, image, title, content, map_url)
                     SELECT id, image, title, content, map_url FROM potential'
                );
            }

            Schema::drop('potential');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('potentials') && ! Schema::hasTable('potential')) {
            Schema::rename('potentials', 'potential');
        }
    }
};
