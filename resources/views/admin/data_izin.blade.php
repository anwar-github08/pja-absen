@extends('admin.layouts.main')

@section('konten')
    @livewire('admin.data-izin', key(time()))
@endsection
