<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;



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

     public function edit(string $id)
    {
        $user  = UserModel::findOrFail($id);
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('edit_user', [
            'title' => 'Edit User',
            'user'  => $user,
            'kelas' => $kelas,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $user = UserModel::findOrFail($id);

        $validated = $request->validate([
            'nama'     => 'required|string|max:100',
            'npm'      => [
                'required','string','max:30',
                Rule::unique('users','nim')->ignore($user->id, 'id'), // abaikan diri sendiri
            ],
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $user->update([
            'name'     => $validated['nama'],
            'nim'      => $validated['npm'],
            'kelas_id' => $validated['kelas_id'],
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $user = UserModel::findOrFail($id);
        $user->delete(); // Eloquent delete

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }

    
}
