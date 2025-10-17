<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserModel extends Model
{
    protected $table = 'users';

    // UUID primary key
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['name','nim','kelas_id','password'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($m) {
            if (empty($m->id)) $m->id = (string) Str::uuid();
        });
    }

    // method list (join ke kelas) untuk tampilan Index
    public static function getUser()
    {
        return DB::table('users')
            ->leftJoin('kelas', 'kelas.id', '=', 'users.kelas_id')
            ->select(
                'users.id',
                'users.name as nama',
                'users.nim',
                'kelas.nama_kelas'
            )
            ->orderBy('users.created_at', 'desc')
            ->get();
    }
}
