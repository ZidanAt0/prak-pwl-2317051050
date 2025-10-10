<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = ['nama_kelas'];

    public static function getKelas()
    {
        return self::orderBy('nama_kelas')->get();
    }
}
