<nav class="navbar navbar-expand-lg bg-white border-bottom">
  <div class="container">
    <a class="navbar-brand fw-semibold" href="{{ route('user.index') }}">PWL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="nav" class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('user.index') }}">Users</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('user.create') }}">Create</a></li>
      </ul>
    </div>
  </div>
</nav>
