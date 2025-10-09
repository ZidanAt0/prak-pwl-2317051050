<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    protected $table = 'users';
    protected $fillable = ['name','nim','kelas_id','password'];


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
            ->orderBy('users.id','desc')
            ->get();
    }
}

