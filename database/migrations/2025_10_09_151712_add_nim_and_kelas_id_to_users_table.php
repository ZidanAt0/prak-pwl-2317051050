<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambah kolom NIM (boleh nullable dulu supaya migrasi tidak gagal untuk data lama)
            if (!Schema::hasColumn('users','nim')) {
                $table->string('nim', 30)->nullable()->unique();
            }

            // Tambah kolom kelas_id + FK ke tabel kelas
            if (!Schema::hasColumn('users','kelas_id')) {
                $table->foreignId('kelas_id')->nullable()
                      ->constrained('kelas')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users','kelas_id')) {
                $table->dropConstrainedForeignId('kelas_id'); // hapus FK + kolom
            }
            if (Schema::hasColumn('users','nim')) {
                $table->dropColumn('nim');
            }
        });
    }
};

