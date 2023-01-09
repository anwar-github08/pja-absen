<?php
date_default_timezone_set('Asia/Bangkok');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <link rel="icon" type="image/png" href="img/sigasik.png">
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

    /* body::before {
        content: "";
        position: fixed;
        inset: 0;
        z-index: -1;
        pointer-events: none;
        background: url("/img/sigasik.jpg") no-repeat center;
        background-size: contain;
        animation: backgroundZoomAnimate 60s infinite alternate forwards;
    } */

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
    }

    .btn-kunjungan:hover,
    .btn-kunjungan:focus {
        background-color: rgb(24, 69, 70);
        color: white;
    }

    @media only screen and (max-width: 768px) {
        .gambar {
            margin-top: 30%;
        }

        .btn-absen,
        .btn-kunjungan {
            font-size: 12px;
        }

        body {
            font-size: 14px
        }

        .dropdown-menu li {
            font-size: 12px
        }
    }

    .preloader {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: black;
        position: fixed;
        top: 0px;
        left: 0px;
        z-index: 9999;
        width: 100%;
        height: 100%;
        opacity: .80;
    }

    .nama_karyawan {

        font-size: 90%;
        color: rgb(47, 135, 108);
        font-style: italic;
        font-weight: bold;
    }
</style>

<body onload="loader()">
    {{-- <div class="">
        <a href="/lokasi">Cek Lokasi</a>
    </div> --}}
    <div class="preloader">
        <img src="/img/preloader.svg" width="120">
    </div>
    <div class="mb-5">
        <a href="/admin">
            <img src="/img/admin.png" width="70">
        </a>
    </div>
    <div class="mb-3 text-center">
        {{-- <h6 class="nama_karyawan">{{ strtoupper($nama_karyawan) }}</h6> --}}
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="nama_karyawan border-0 bg-transparent"
                onclick="return confirm('Keluar..?')">{{ strtoupper($nama_karyawan) }}</button>
        </form>
    </div>
    @if (date('H:i') < '06:00' or date('H:i') > '21:00' or date('D') == 'Sun')
        <div class="text-dark" style="font-style: italic"><strong> Tidak Bisa Diakses</strong></div>
    @elseif(auth()->user()->is_admin == true)
    @else
        <div class="row text-center">

            <div class="col-md-6 col-sm-6 mb-3">
                <div class="dropdown">
                    <a class="btn btn-absen btn-lg dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
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
                <a href="/kunjungan" class="btn btn-kunjungan btn-lg">Kunjungan</a>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mt-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="gambar mt-5">
        <img src="/img/sigasik.jpg" class="img-fluid" alt="" width="1500">
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>

<script>
    function loader() {
        setTimeout(function() {
            $('.preloader').fadeOut()
        }, 1000);
    };
</script>
