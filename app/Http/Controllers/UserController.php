<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public $userModel;
    public $kelasModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kelasModel = new Kelas();
    }
    public function create(){
        $kelasModel = new Kelas();
        $kelas = $kelasModel -> getKelas();
        $data = [
            'title' => 'Create User',
            'kelas' => $kelas,
        ];
        return view('create_user', $data);
    }


public function store(Request $request)
{
    $validated = $request->validate([
        'nama'     => 'required|string|max:100',
        'npm'      => 'required|string|max:30|unique:users,nim',
        'kelas_id' => 'required|exists:kelas,id',
    ]);

    $this->userModel->create([
        'name'     => $validated['nama'],
        'nim'      => $validated['npm'],
        'kelas_id' => $validated['kelas_id'],
        'password' => Hash::make(Str::random(24)), // ← password dummy supaya NOT NULL terpenuhi
    ]);

    return redirect()->to('/user')->with('success','User berhasil ditambahkan');
}

    public function getUser()
    {
        return $this->join('kelas', 'kelas.id', '=', 'user.kelas_id')
                    ->select('user.*', 'kelas.nama_kelas as nama_kelas')
                    ->get();
    }

    public function index(Request $request)
    {
        $q = $request->query('q');
        $users = $this->userModel->getUser();

        if ($q) {
            $qLower = mb_strtolower($q);
            $users = $users->filter(function ($u) use ($qLower) {
                return str_contains(mb_strtolower($u->nama), $qLower)
                    || str_contains(mb_strtolower($u->nim), $qLower)
                    || str_contains(mb_strtolower($u->nama_kelas), $qLower);
            })->values();
        }

        return view('list_user', [
            'title' => 'List User',
            'users' => $users,
            'q'     => $q,
        ]);
    }

    
}
