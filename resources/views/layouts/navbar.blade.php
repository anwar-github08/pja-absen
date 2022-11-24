<nav class="navbar navbar-expand-lg bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">SIGASIK</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ $title == 'SIGASIK' ? 'active' : '' }}" aria-current="page"
                        href="/">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ $title == 'Absen Istirahat' ? 'active' : '' }}" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Absen
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($jabatans as $jabatan)
                            <li><a class="dropdown-item" href="#">{{ $jabatan->nama_jabatan }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ $title == 'Absen Istirahat' ? 'active' : '' }}" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Kunjungan
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($jabatans as $jabatan)
                            <li><a class="dropdown-item" href="#">{{ $jabatan->nama_jabatan }}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="/admin" class="nav-link">Admin</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
