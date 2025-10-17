@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-12 col-md-10 col-lg-8 col-xl-6">

    <div class="mb-4">
      <h1 class="h4 fw-bold mb-1">Edit User</h1>
      <p class="text-muted mb-0">Perbarui data mahasiswa.</p>
    </div>

    @if ($errors->any())
      <div class="alert alert-danger">
        <div class="fw-semibold mb-1">Periksa input berikut:</div>
        <ul class="mb-0 ps-3">
          @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
      </div>
    @endif

    <div class="card shadow-sm">
      <div class="card-body p-4">
        <form action="{{ route('user.update', $user->id) }}" method="POST" class="vstack gap-3">
          @csrf
          @method('PUT')

          <div class="form-floating">
            <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror"
                   value="{{ old('nama', $user->name) }}" placeholder="Nama" required>
            <label for="nama">Nama</label>
            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="form-floating">
            <input type="text" id="npm" name="npm" class="form-control @error('npm') is-invalid @enderror"
                   value="{{ old('npm', $user->nim) }}" placeholder="NPM/NIM" required>
            <label for="npm">NPM / NIM</label>
            @error('npm') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="form-floating">
            <select id="kelas_id" name="kelas_id" class="form-select @error('kelas_id') is-invalid @enderror" required>
              @foreach ($kelas as $k)
                <option value="{{ $k->id }}" {{ old('kelas_id', $user->kelas_id) == $k->id ? 'selected' : '' }}>
                  {{ $k->nama_kelas }}
                </option>
              @endforeach
            </select>
            <label for="kelas_id">Kelas</label>
            @error('kelas_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="d-flex gap-2">
            <button class="btn btn-primary px-4" type="submit">Simpan</button>
            <a class="btn btn-outline-secondary" href="{{ route('user.index') }}">Batal</a>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>
@endsection
