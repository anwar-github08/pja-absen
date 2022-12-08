@extends('layouts.main')
@section('konten')
    <h5 class="fr">Kunjungan Tanggal {{ date('d-m-Y') }}</h5>
    <hr>
    @livewire('kunjungan.kunjungan-create')
    @livewire('kunjungan.kunjungan-show')
@endsection
