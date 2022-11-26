@extends('admin.layouts.main')

@section('konten')
    @livewire('admin.data-kunjungan', key(time()))
@endsection
