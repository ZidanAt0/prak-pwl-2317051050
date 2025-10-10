@extends('layouts.app')

@section('content')
<div class="container py-4">

  {{-- Header --}}
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
    <div>
      <h1 class="h4 fw-bold mb-1">Daftar Pengguna</h1>
      <p class="text-muted mb-0">Kelola data mahasiswa dengan mudah.</p>
    </div>
    <a href="{{ route('user.create') }}" class="btn btn-primary mt-3 mt-md-0 px-4">
      <i class="bi bi-person-plus me-1"></i> Tambah
    </a>
  </div>

  {{-- Pencarian --}}
  <form method="GET" action="{{ route('user.index') }}" class="mb-4">
    <div class="input-group shadow-sm">
      <input
        type="text"
        name="q"
        class="form-control"
        placeholder="🔍  Cari nama / NPM / kelas..."
        value="{{ $q }}"
      >
      <button class="btn btn-outline-secondary" type="submit">Cari</button>
      <a href="{{ route('user.index') }}" class="btn btn-light border">Reset</a>
    </div>
  </form>

  {{-- Pesan sukses --}}
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  {{-- Tabel / Kartu pengguna --}}
  @if ($users->isEmpty())
    <div class="text-center text-muted py-5">
      <i class="bi bi-database fs-1 d-block mb-2"></i>
      Belum ada data atau tidak ditemukan.
    </div>
  @else
    <div class="table-responsive">
      <table class="table align-middle table-hover border shadow-sm rounded-3 overflow-hidden">
        <thead class="table-light">
          <tr class="text-center">
            <th width="5%">#</th>
            <th>Nama</th>
            <th>NPM</th>
            <th>Kelas</th>
            <th width="15%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $i => $u)
            <tr class="text-center">
              <td>{{ $i + 1 }}</td>
              <td class="text-start fw-semibold">{{ $u->nama }}</td>
              <td>{{ $u->nim }}</td>
              <td>
                <span class="badge bg-primary-subtle text-primary border">{{ $u->nama_kelas }}</span>
              </td>
              <td>
                <button class="btn btn-sm btn-outline-secondary" disabled>
                  <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-sm btn-outline-primary" disabled>
                  <i class="bi bi-pencil-square"></i>
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif

</div>
@endsection
