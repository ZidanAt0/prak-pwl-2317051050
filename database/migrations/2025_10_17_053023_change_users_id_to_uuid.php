<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1) kolom UUID sementara (nullable supaya bisa ditambah pada tabel berisi data)
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('uuid_tmp')->nullable();
        });

        // 2) isi semua baris dengan UUID
        DB::statement('UPDATE users SET uuid_tmp = gen_random_uuid()');

        // 3) lepas primary key lama (berbasis kolom id bigint)
        DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_pkey');

        // 4) hapus kolom id lama (bigint)
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        // 5) rename uuid_tmp -> id
        DB::statement('ALTER TABLE users RENAME COLUMN uuid_tmp TO id');

        // 6) jadikan NOT NULL + set primary key
        DB::statement('ALTER TABLE users ALTER COLUMN id SET NOT NULL');
        DB::statement('ALTER TABLE users ADD PRIMARY KEY (id)');
    }

    public function down(): void
    {
        // rollback ke bigint tidak diperlukan untuk praktikum ini
    }
};
