@extends('admin.layouts.main')

@section('konten')
    <?php if ($kategori == 'datang') : ?>
    <img src="/storage/foto_datang/{{ $image }}" class="img-fluid img-thumbnail" alt="foto_datang">
    <?php else : ?>
    <img src="/storage/foto_pulang/{{ $image }}" class="img-fluid img-thumbnail" alt="foto_pulang">
    <?php endif ?>
@endsection
