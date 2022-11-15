@extends('layouts.main')
@section('konten')
    <h5>Absen Istirahat Keluar Tanggal {{ date('d-m-Y') }}</h5>
    <hr>
    @livewire('istirahat.is-keluar-create')
    @livewire('istirahat.is-keluar-show')
@endsection
