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
        // HANYA buat kalau belum ada
        if (!Schema::hasTable('kelas')) {
            Schema::create('kelas', function (Blueprint $table) {
                $table->id();
                $table->string('nama_kelas'); // atau string('nama_kelas', 50)
                $table->timestamps();
            });
        } else {
            // (Opsional) kalau tabel sudah ada tapi kolom 'nama_kelas' belum ada
            if (!Schema::hasColumn('kelas', 'nama_kelas')) {
                Schema::table('kelas', function (Blueprint $table) {
                    $table->string('nama_kelas')->nullable();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
