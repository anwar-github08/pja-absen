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
                <th>Jam Kunjungan</th>
                <th>Lokasi</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kunjungans as $kunjungan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kunjungan->karyawan->nama_karyawan }}</td>
                    <td>{{ $kunjungan->jam_kunjungan }}</td>
                    <td>{{ $kunjungan->lokasi_kunjungan }}</td>
                    <td>
                        <img src="/storage/foto_kunjungan/{{ $kunjungan->foto_kunjungan }}" alt="foto_kunjungan"
                            width="100">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
