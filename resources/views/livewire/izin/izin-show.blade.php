<div class="mt-5">
    @if (session()->has('sukses'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('sukses') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-bordered table-fluid text-white text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Karyawan</th>
                <th>Jam izin</th>
                <th>Lokasi</th>
                <th>Keperluan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($izins as $izin)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $izin->karyawan->nama_karyawan }}</td>
                    <td>{{ $izin->jam_izin }}</td>
                    <td>{{ $izin->lokasi_izin }}</td>
                    <td>{{ $izin->keperluan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>