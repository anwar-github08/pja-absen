@extends('layouts.main')
@section('konten')
    <h5>Absen Izin Tanggal {{ date('d-m-Y') }}</h5>
    <hr>
    @livewire('izin.izin-create')
    @livewire('izin.izin-show')
@endsection
