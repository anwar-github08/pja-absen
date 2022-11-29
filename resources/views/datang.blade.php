@extends('layouts.main')
@section('konten')
    <h5 class="fr">Absen Datang Tanggal {{ date('d-m-Y') }}</h5>
    <hr>
    @livewire('datang.datang-create')
    @livewire('datang.datang-show')
@endsection
