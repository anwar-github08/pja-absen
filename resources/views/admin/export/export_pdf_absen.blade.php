<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        th,
        td {
            text-align: center;
            padding: 8px;
        }
    </style>

</head>

<body>
    <div style="text-align: center">
        <h2>Data Absen</h2>
        <h3>Periode : {{ $tanggal }}</h3>
    </div>
    <table border="1" style="width: 100%">
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
            </tr>
        </thead>
        <tbody>
            @foreach ($absens as $absen)
                <tr style="height: 100px">
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
                            <img src="/storage/foto_pulang/{{ $absen->pulang->foto_pulang }}" alt="foto_pulang"
                                width="100">
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
