@extends('admin.layouts.main')

@section('konten')
    @livewire('admin.data-absen', key(time()))
@endsection
