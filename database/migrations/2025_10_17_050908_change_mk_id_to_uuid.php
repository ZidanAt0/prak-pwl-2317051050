<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1) tambah kolom baru
        Schema::table('mata_kuliah', function (Blueprint $table) {
            $table->uuid('uuid_tmp')->nullable();
        });

        // 2) isi dengan UUID
        DB::statement('UPDATE mata_kuliah SET uuid_tmp = gen_random_uuid()');

        // 3) drop PK lama
        DB::statement('ALTER TABLE mata_kuliah DROP CONSTRAINT IF EXISTS mata_kuliah_pkey');

        // 4) hapus kolom id lama (bigint)
        Schema::table('mata_kuliah', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        // 5) rename uuid_tmp -> id dan jadikan PK
        Schema::table('mata_kuliah', function (Blueprint $table) {
            $table->uuid('id')->first();
        });
        DB::statement('ALTER TABLE mata_kuliah ADD PRIMARY KEY (id)');
    }

    public function down(): void
    {
        // (opsional) balik ke bigint auto-increment — tidak perlu untuk praktikum
    }
};
