<table class="table table-striped align-middle mb-0">
  <thead class="table-light">
    <tr>
      <th>#</th>
      <th>Nama</th>
      <th>NPM</th>
      <th>Kelas</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $u)
      <tr>
        <td>{{ $u->id }}</td>
        <td>{{ $u->nama }}</td>
        <td>{{ $u->nim }}</td>
        <td><span class="badge bg-primary-subtle text-primary border">{{ $u->nama_kelas }}</span></td>
      </tr>
    @endforeach
  </tbody>
</table>
