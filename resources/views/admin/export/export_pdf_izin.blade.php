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
        <h2>Data Izin</h2>
        <h3>Periode : {{ $tanggal }}</h3>
    </div>
    <table border="1" style="width: 100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Karyawan</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Keperluan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($izins as $izin)
                <tr style="height: 100px">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $izin->karyawan->nama_karyawan }}</td>
                    <td>{{ date('d-m-Y', strtotime($izin->tanggal_izin)) }}</td>
                    <td>{{ $izin->jam_izin }}</td>
                    <td>{{ $izin->keperluan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
