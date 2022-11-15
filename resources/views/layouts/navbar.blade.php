<nav class="navbar navbar-expand-lg bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">PJA-ABSEN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ $title == 'PJA-ABSEN' ? 'active' : '' }}" aria-current="page"
                        href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $title == 'Absen Datang' ? 'active' : '' }}" href="/datang">Datang</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ $title == 'Absen Istirahat' ? 'active' : '' }}" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Istirahat
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/is_keluar">Keluar</a></li>
                        <li><a class="dropdown-item" href="/is_masuk">Masuk</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $title == 'Absen Pulang' ? 'active' : '' }}" href="/pulang">Pulang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $title == 'Absen Izin' ? 'active' : '' }}" href="/izin">Izin</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
