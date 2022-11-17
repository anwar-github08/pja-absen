<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ $title == 'Dashboard' ? 'active' : '' }}" href="/admin">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $title == 'Data Absen' ? 'active' : '' }}" href="/data_absen">Data Absen</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $title == 'Data Karyawan' ? 'active' : '' }}" href="/karyawan">Master
                    Karyawan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/" onclick="return confirm('ke halaman utama?')">Home User</a>
            </li>
        </ul>
    </div>
</nav>
