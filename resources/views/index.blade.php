<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <title>SIGASIK</title>
</head>

<style>
    body {
        font: 18px sans-serif;
        color: white;
        height: 100%;
        margin-top: 5%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    body::before {
        content: "";
        position: fixed;
        inset: 0;
        z-index: -1;
        pointer-events: none;
        background: url("/img/sigasik.jpg") no-repeat center;
        background-size: contain;
        animation: backgroundZoomAnimate 60s infinite alternate forwards;
    }

    @keyframes backgroundZoomAnimate {
        from {
            transform: scale(0.8);
        }

        to {
            transform: scale(0.9);
        }
    }

    .btn-absen {
        background-color: rgb(8, 85, 140);
        color: white;
        width: 250px;
    }

    .btn-kunjungan {
        background-color: rgb(47, 135, 108);
        color: white;
        width: 250px;
    }

    .btn-absen:hover,
    .btn-absen:focus {
        background-color: rgb(10, 44, 68);
        color: white;
        width: 250px;
    }

    .btn-kunjungan:hover,
    .btn-kunjungan:focus {
        background-color: rgb(24, 69, 70);
        color: white;
        width: 250px;
    }

    /* @media only screen and (max-width: 768px) {
        body {
            margin-top: 30%;
        }
    } */
</style>

<body>
    <div class="">
        <a href="/lokasi">Cek Lokasi</a>
    </div>
    <div class="mb-5">
        <a href="/admin">
            <img src="/img/admin.png" width="70">
        </a>
    </div>

    <div class="row text-center">

        <div class="col-md-6 col-sm-6 mb-3">
            <div class="dropdown">
                <a class="btn btn-absen btn-lg dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Absen
                </a>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/datang">Datang</a></li>
                    <li><a class="dropdown-item" href="/is_keluar">Istirahat Keluar</a></li>
                    <li><a class="dropdown-item" href="/is_masuk">Istirahat Masuk</a></li>
                    <li><a class="dropdown-item" href="/pulang">Pulang</a></li>
                    <li><a class="dropdown-item" href="/izin">Izin</a></li>
                </ul>
            </div>
        </div>

        <div class="col-md-6 col-sm-6">
            <div class="dropdown">
                <a class="btn btn-kunjungan btn-lg dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Kunjungan
                </a>

                <ul class="dropdown-menu">
                    @foreach ($jabatans as $jabatan)
                        <li><a class="dropdown-item"
                                href="/kunjungan/{{ $jabatan->jabatan->id }}">{{ $jabatan->jabatan->nama_jabatan }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
