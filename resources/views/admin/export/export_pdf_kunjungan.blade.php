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
        <h2>Data Absen Kunjungan</h2>
        <h3>Periode : {{ $tanggal }}</h3>
    </div>
    <table border="1" style="width: 100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Karyawan</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Foto Kunjungan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kunjungans as $kunjungan)
                <tr style="height: 100px">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kunjungan->karyawan->nama_karyawan }}</td>
                    <td>{{ date('d-m-Y', strtotime($kunjungan->tanggal_kunjungan)) }}</td>
                    <td>{{ $kunjungan->jam_kunjungan }}</td>
                    <td><img src="/storage/foto_kunjungan/{{ $kunjungan->foto_kunjungan }}" alt="foto_kunjungan"
                            width="100"></td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
