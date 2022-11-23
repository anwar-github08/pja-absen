<div>
    <div class="col-md-4">
        <div class="input-group mb-4">
            <input type="text" wire:model='tanggal' id="tgl" class="form-control" placeholder="Tanggal"
                autocomplete="off">
            @if ($tanggal == '')
                <button class="btn btn-primary" wire:click='showData' disabled>Tampilkan</button>
            @else
                <button class="btn btn-primary" wire:click='showData'>Tampilkan</button>
            @endif
        </div>
    </div>

    <table class="table table-bordered table-fluid text-white text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Karyawan</th>
                <th>Tanggal</th>
                <th>Datang</th>
                <th>Ist. Keluar</th>
                <th>Ist. Masuk</th>
                <th>Pulang</th>
                <th>Foto Datang</th>
                <th>Foto Pulang</th>
                <th>Detail</th>
                <th>Izin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absens as $absen)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $absen->karyawan->nama_karyawan }}</td>
                    <td>{{ date('d-m-Y', strtotime($absen->tanggal_absen)) }}</td>
                    <td>{{ $absen->datang->jam_datang }}</td>
                    <td>{{ $absen->is_keluar->jam_is_keluar }}</td>
                    <td>{{ $absen->is_masuk->jam_is_masuk }}</td>
                    <td>{{ $absen->pulang->jam_pulang }}</td>
                    <td>
                        @if ($absen->datang->foto_datang == null)
                            -
                        @else
                            <img src="/storage/foto_datang/{{ $absen->datang->foto_datang }}" alt="foto_datang"
                                width="100">
                        @endif
                    </td>

                    <td>
                        @if ($absen->pulang->foto_pulang == null)
                            -
                        @else
                            <img src="/storage/foto_pulang/{{ $absen->pulang->foto_pulang }}" alt="foto_datang"
                                width="100">
                        @endif
                    </td>
                    <td><a href="detailAbsen/{{ $absen->id }}" target="blank" class="btn btn-info btn-sm">Detail</a>
                    </td>
                    <td>
                        @if ($absen->izin->jam_izin == null)
                            -
                        @else
                            <a href="/detailIzin/{{ $absen->izin->id }}" class="btn btn-sm btn-info">Lihat izin</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- 
<input type="text" id="textCopy{{ $absen->id }}" value="{{ $absen->datang->lokasi_datang }}">
<button class="btn btn-sm btn-secondary" onclick="copy({{ $absen->id }})">salin
    lokasi</button> --}}
