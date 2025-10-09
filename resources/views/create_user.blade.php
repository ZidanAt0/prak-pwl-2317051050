@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-12 col-md-10 col-lg-8 col-xl-6">

    {{-- Header --}}
    <div class="mb-4 text-center">
      <h1 class="fw-bold display-6 mb-1">Buat Pengguna Baru</h1>
      <p class="text-muted mb-0">Isi data di bawah dengan benar lalu klik Submit.</p>
    </div>

    {{-- Notif sukses/gagal umum --}}
    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
      <div class="alert alert-danger">
        <div class="fw-semibold mb-1">Ada yang perlu dicek:</div>
        <ul class="mb-0 ps-3">
          @foreach ($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Card Form --}}
    <div class="card shadow-sm border-0">
      <div class="card-body p-4 p-lg-5">
        <form action="{{ route('user.store') }}" method="POST" class="vstack gap-4">
          @csrf

          {{-- Nama --}}
          <div class="form-floating">
            <input
              type="text"
              id="nama"
              name="nama"
              class="form-control @error('nama') is-invalid @enderror"
              placeholder="Nama lengkap"
              value="{{ old('nama') }}"
              required
            >
            <label for="nama">Nama</label>
            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          {{-- NPM --}}
          <div class="form-floating">
            <input
              type="text"
              id="npm"
              name="npm"
              class="form-control @error('npm') is-invalid @enderror"
              placeholder="NPM / NIM"
              value="{{ old('npm') }}"
              required
            >
            <label for="npm">NPM / NIM</label>
            @error('npm') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          {{-- Kelas --}}
          <div class="form-floating">
            <select
              id="kelas_id"
              name="kelas_id"
              class="form-select @error('kelas_id') is-invalid @enderror"
              required
            >
              <option value="" disabled {{ old('kelas_id') ? '' : 'selected' }}>Pilih kelas</option>
              @foreach ($kelas as $k)
                <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                  {{ $k->nama_kelas }}
                </option>
              @endforeach
            </select>
            <label for="kelas_id">Kelas</label>
            @error('kelas_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          {{-- Tombol --}}
          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4">
              Submit
            </button>
            <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">
              Batal
            </a>
          </div>
        </form>
      </div>
    </div>

    {{-- Catatan kecil --}}
    <div class="text-center text-muted small mt-3">
      Pastikan NPM unik dan kelas sudah tersedia.
    </div>

  </div>
</div>
@endsection
