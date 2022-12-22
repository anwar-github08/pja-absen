@extends('admin.layouts.main')

@section('konten')
    @foreach ($izins as $izin)
        <div class="d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card bg-secondary">
                    <div class="card-header">
                        <h4>{{ $izin->karyawan->nama_karyawan }}</h4>
                    </div>
                    <div class="card-body">
                        <h6>Tanggal : {{ date('d-m-Y', strtotime($izin->tanggal_izin)) }}</h6>
                        <h6>Jam : {{ $izin->jam_izin }}</h6>
                        <br>
                        <h6>Lokasi</h6>
                        <a href="https://www.google.com/maps/place/{{ $izin->lokasi_izin }}" target='_blank'
                            style="color: white">{{ $izin->lokasi_izin }}</a>
                        <h6 class="mt-2">Keperluan</h6>
                        <textarea class="form-control" disabled>{{ $izin->keperluan }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
