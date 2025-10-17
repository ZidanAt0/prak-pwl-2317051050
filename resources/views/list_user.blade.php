@extends('layouts.app')

@section('content')
<div class="container py-4">

  <div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h4 fw-bold m-0">Daftar Pengguna</h1>
    <a href="{{ route('user.create') }}" class="btn btn-primary">
      <i class="bi bi-person-plus"></i> Tambah
    </a>
  </div>

  {{-- Notifikasi --}}
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      Terjadi kesalahan. Periksa input Anda.
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if ($users->isEmpty())
    <div class="text-center text-muted py-5">Belum ada data.</div>
  @else
    <div class="table-responsive">
      <table class="table align-middle table-hover shadow-sm">
        <thead class="table-light">
          <tr class="text-center">
            <th>#</th>
            <th class="text-start">Nama</th>
            <th>NPM</th>
            <th>Kelas</th>
            <th width="18%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $i => $u)
            <tr class="text-center">
              <td>{{ $i + 1 }}</td>
              <td class="text-start fw-semibold">{{ $u->nama }}</td>
              <td>{{ $u->nim }}</td>
              <td><span class="badge bg-primary-subtle text-primary border">{{ $u->nama_kelas }}</span></td>
              <td>
                <div class="d-flex justify-content-center gap-2">
                  <a href="{{ route('user.edit', $u->id) }}" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-pencil-square"></i> Edit
                  </a>

                  <form action="{{ route('user.destroy', $u->id) }}" method="POST"
                        onsubmit="return confirm('Hapus user ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                      <i class="bi bi-trash"></i> Hapus
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif

</div>
<link rel="stylesheet"
 href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@endsection
