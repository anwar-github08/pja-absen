@extends('layouts.main')
@section('konten')
    <div class="row">
        <div class="link text-center">
            <a href="/datang/{{ $id_jabatan }}" class="btn btn-primary btn-lg mb-3">Datang</a>
            <a href="/is_keluar/{{ $id_jabatan }}" class="btn btn-secondary btn-lg mb-3">Istirahat Keluar</a>
            <a href="/is_masuk/{{ $id_jabatan }}" class="btn btn-secondary btn-lg mb-3">Istirahat Masuk</a>
            <a href="/pulang/{{ $id_jabatan }}" class="btn btn-danger btn-lg mb-3">Pulang</a>
            <a href="/izin/{{ $id_jabatan }}" class="btn btn-success btn-lg">Izin</a>
        </div>
    </div>
@endsection
