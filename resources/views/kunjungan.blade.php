@extends('layouts.main')
@section('konten')
    <h5 class="fr">Kunjungan Tanggal {{ date('d-m-Y') }}</h5>
    <hr>
    @livewire('kunjungan.kunjungan-create', ['id_jabatan' => $id_jabatan])
    @livewire('kunjungan.kunjungan-show')
@endsection
