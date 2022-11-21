<div>
    <table class="table table-bordered table-fluid text-white text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Karyawan</th>
                <th>Datang</th>
                <th>Ist. Keluar</th>
                <th>Ist. Masuk</th>
                <th>Pulang</th>
                <th>Foto Datang</th>
                <th>Foto Pulang</th>
                <th>Izin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absens as $absen)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $absen->karyawan->nama_karyawan }}</td>
                    <td>{{ $absen->datang->jam_datang }}</td>
                    <td>{{ $absen->is_keluar->jam_is_keluar }}</td>
                    <td>{{ $absen->is_masuk->jam_is_masuk }}</td>
                    <td>{{ $absen->pulang->jam_pulang }}</td>
                    <td>
                        <?php if ($absen->datang->foto_datang == null) : ?>
                        -
                        <?php else : ?>
                        <a href="/showImage/datang/{{ $absen->datang->foto_datang }}" class="btn btn-info btn-sm">Lihat
                            Foto</a>
                        <?php endif ?>
                    </td>

                    <td>
                        <?php if ($absen->pulang->foto_pulang == null) : ?>
                        -
                        <?php else : ?>
                        <a href="/showImage/pulang/{{ $absen->pulang->foto_pulang }}" class="btn btn-info btn-sm">Lihat
                            Foto</a>
                        <?php endif ?>
                    </td>
                    <td>{{ $absen->izin->jam_izin }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
