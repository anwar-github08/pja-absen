@extends('layouts.main')
@section('konten')
    <h5 class="fr">Absen Istirahat Masuk Tanggal {{ date('d-m-Y') }}</h5>
    <hr>
    @livewire('istirahat.is-masuk-create')
    @livewire('istirahat.is-masuk-show')
@endsection
