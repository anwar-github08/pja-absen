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
                <th>Jam Datang</th>
                <th>Lokasi</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datangs as $datang)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $datang->karyawan->nama_karyawan }}</td>
                    <td>{{ $datang->jam_datang }}</td>
                    <td>{{ $datang->lokasi_datang }}</td>
                    <td>
                        <img src="/storage/foto_datang/{{ $datang->foto_datang }}" alt="foto_datang" width="70">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
