<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ $title == 'Dashboard' ? 'active' : '' }}" href="/admin">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($title == 'Data Absen') | ($title == 'Detail Absen') | ($title == 'Detail Izin') ? 'active' : '' }}"
                    href="/data_absen">Data Absen</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($title == 'Data Kunjungan') | ($title == 'Detail Kunjungan') ? 'active' : '' }}"
                    href="/data_kunjungan">Data Kunjungan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $title == 'Data Jabatan' ? 'active' : '' }}" href="/jabatan">Master
                    Jabatan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $title == 'Data Karyawan' ? 'active' : '' }}" href="/karyawan">Master
                    Karyawan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $title == 'Akses Kunjungan' ? 'active' : '' }}" href="/akses_kunjungan">Akses
                    Kunjungan</a>
            </li>

            {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Export
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/exportAbsen">Data Absen</a></li>
                    <li><a class="dropdown-item" href="/exportKunjungan">Data Kunjungan</a></li>
                </ul>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link" href="/" onclick="return confirm('ke halaman utama..?')">Home User</a>
            </li>
            <li class="nav-item">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-transparent"
                        onclick="return confirm('logout..?')">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
