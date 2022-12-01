@extends('admin.layouts.main')

@section('konten')
    @foreach ($kunjungans as $kunjungan)
        <div class="d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card bg-secondary">
                    <div class="card-header">
                        <h4>{{ $kunjungan->karyawan->nama_karyawan }}</h4>
                    </div>
                    <div class="card-body">
                        <h6>Tanggal : {{ date('d-m-Y', strtotime($kunjungan->tanggal_kunjungan)) }}</h6>
                        <h6>Jam : {{ $kunjungan->jam_kunjungan }}</h6>
                        <br>
                        <h6>Lokasi</h6>
                        <div class="input-group mb-4">
                            <input type="text" id="textCopyKunjungan" class="form-control form-control-sm"
                                value="{{ $kunjungan->lokasi_kunjungan }}">
                            <button class="btn btn-sm btn-primary" onclick="copy('Kunjungan')">salin
                                lokasi</button>
                        </div>
                        <h6>Foto</h6>
                        <div class="text-center">
                            <img src="/storage/foto_kunjungan/{{ $kunjungan->foto_kunjungan }}" class="img-fluid mb-3 mt-3"
                                alt="foto_kunjungan" width="500">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
