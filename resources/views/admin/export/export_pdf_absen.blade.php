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
                <th>Foto Datang</th>
                <th>Ist. Keluar</th>
                <th>Ist. Masuk</th>
                <th>Pulang</th>
                <th>Foto Pulang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absens as $absen)
                <tr style="height: 100px">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $absen->karyawan->nama_karyawan }}</td>
                    <td>{{ date('d-m-Y', strtotime($absen->tanggal_absen)) }}</td>
                    <td>

                        {{ $absen->datang->jam_datang }} <br>

                        @if (strtotime($absen->datang->jam_datang) < strtotime($absen->jam_kerja->jam_datang) and
                                strtotime($absen->datang->jam_datang) > strtotime($absen->jam_kerja->jam_sebelum_datang))
                            <small style="color:black"><i>datang lebih awal
                                    {{ (strtotime(date('H:i', strtotime($absen->jam_kerja->jam_datang))) - strtotime(date('H:i', strtotime($absen->datang->jam_datang)))) / 60 }}
                                    menit</i></small>
                        @elseif(strtotime($absen->datang->jam_datang) > strtotime($absen->jam_kerja->jam_datang) and
                                strtotime($absen->datang->jam_datang) <= strtotime($absen->jam_kerja->jam_setelah_datang))
                            <small style="color: black"><i>datang terlambat
                                    {{ (strtotime(date('H:i', strtotime($absen->datang->jam_datang))) - strtotime(date('H:i', strtotime($absen->jam_kerja->jam_datang)))) / 60 }}
                                    menit</i></small>
                        @elseif($absen->datang->jam_datang == null)
                        @else
                            <small style="color: black"><i> tidak hadir</i></small>
                        @endif
                    </td>
                    <td>
                        @if ($absen->datang->foto_datang == null)
                            -
                        @else
                            <img src="/storage/foto_datang/{{ $absen->datang->foto_datang }}" alt="foto_datang"
                                width="50"><br>
                            <a href="https://www.google.com/maps/place/{{ $absen->datang->lokasi_datang }}"
                                target='_blank'>{{ $absen->datang->lokasi_datang }}</a>
                        @endif
                    </td>
                    <td>
                        {{ $absen->is_keluar->jam_is_keluar }}
                        <br>
                        <a href="https://www.google.com/maps/place/{{ $absen->is_keluar->lokasi_is_keluar }}"
                            target='_blank'>{{ $absen->is_keluar->lokasi_is_keluar }}</a>
                    </td>
                    <td>
                        {{ $absen->is_masuk->jam_is_masuk }}
                        <br>
                        <a href="https://www.google.com/maps/place/{{ $absen->is_masuk->lokasi_is_masuk }}"
                            target='_blank'>{{ $absen->is_masuk->lokasi_is_masuk }}</a>
                    </td>

                    <td>
                        {{ $absen->pulang->jam_pulang }} <br>

                        @if (strtotime($absen->pulang->jam_pulang) < strtotime($absen->jam_kerja->jam_pulang) and
                                strtotime($absen->pulang->jam_pulang) > strtotime($absen->jam_kerja->jam_sebelum_pulang))
                            <small style="color:black"><i>pulang lebih awal
                                    {{ (strtotime(date('H:i', strtotime($absen->jam_kerja->jam_pulang))) - strtotime(date('H:i', strtotime($absen->pulang->jam_pulang)))) / 60 }}
                                    menit</i></small>
                        @elseif(strtotime($absen->pulang->jam_pulang) > strtotime($absen->jam_kerja->jam_pulang) and
                                strtotime($absen->pulang->jam_pulang) <= strtotime($absen->jam_kerja->jam_setelah_pulang))
                            <small style="color: black"><i>pulang terlambat
                                    {{ (strtotime(date('H:i', strtotime($absen->pulang->jam_pulang))) - strtotime(date('H:i', strtotime($absen->jam_kerja->jam_pulang)))) / 60 }}
                                    menit</i></small>
                        @elseif($absen->pulang->jam_pulang == null)
                        @else
                            <small style="color: black"><i> bolos</i></small>
                        @endif
                    </td>

                    <td>
                        @if ($absen->pulang->foto_pulang == null)
                            -
                        @else
                            <img src="/storage/foto_pulang/{{ $absen->pulang->foto_pulang }}" alt="foto_pulang"
                                width="50"><br>
                            <a href="https://www.google.com/maps/place/{{ $absen->pulang->lokasi_pulang }}"
                                target='_blank'>{{ $absen->pulang->lokasi_pulang }}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
