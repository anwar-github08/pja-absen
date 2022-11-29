@extends('layouts.main')
@section('konten')
    <h5 class="fr">Absen Pulang Tanggal {{ date('d-m-Y') }}</h5>
    <hr>
    @livewire('pulang.pulang-create')
    @livewire('pulang.pulang-show')
@endsection
