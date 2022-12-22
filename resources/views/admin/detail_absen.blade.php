@extends('admin.layouts.main')

@section('konten')
    @foreach ($absens as $absen)
        <div class="card bg-secondary">
            <div class="card-header">
                <h4>{{ $absen->karyawan->nama_karyawan }}</h4>
            </div>
            <div class="card-body">
                <h5>Tanggal : {{ date('d-m-Y', strtotime($absen->tanggal_absen)) }}</h5>
                <hr>
                <div class="row">
                    <div class="col-md-4 mb-3">

                        {{-- datang --}}
                        <h5>Datang</h5>
                        @if ($absen->datang->jam_datang == null)
                            -
                        @else
                            <img src="/storage/foto_datang/{{ $absen->datang->foto_datang }}" class="img-fluid mb-3 mt-3"
                                alt="foto_datang" width="500">

                            <h6>Jam : {{ $absen->datang->jam_datang }}</h6>
                            <br>
                            <h6>Lokasi</h6>
                            <a href="https://www.google.com/maps/place/{{ $absen->datang->lokasi_datang }}" target='_blank'
                                style="color: white">{{ $absen->datang->lokasi_datang }}</a>
                        @endif
                    </div>
                    {{-- is keluar --}}
                    <div class="col-md-2 mb-3">
                        <h5>Istirahat Keluar</h5>
                        <br>
                        @if ($absen->is_keluar->jam_is_keluar == null)
                            -
                        @else
                            <h6>Jam : {{ $absen->is_keluar->jam_is_keluar }}</h6>
                            <h6>Lokasi</h6>
                            <a href="https://www.google.com/maps/place/{{ $absen->is_keluar->lokasi_is_keluar }}"
                                target='_blank' style="color: white">{{ $absen->is_keluar->lokasi_is_keluar }}</a>
                        @endif
                    </div>

                    {{-- is masuk --}}
                    <div class="col-md-2 mb-3">
                        <h5>Istirahat Masuk</h5>
                        <br>
                        @if ($absen->is_masuk->jam_is_masuk == null)
                            -
                        @else
                            <h6>Jam : {{ $absen->is_masuk->jam_is_masuk }}</h6>
                            <h6>Lokasi</h6>
                            <a href="https://www.google.com/maps/place/{{ $absen->is_masuk->lokasi_is_masuk }}"
                                target='_blank' style="color: white">{{ $absen->is_masuk->lokasi_is_masuk }}</a>
                        @endif
                    </div>

                    {{-- pulang --}}
                    <div class="col-md-4 mb-3">
                        <h5>Pulang</h5>
                        @if ($absen->pulang->jam_pulang == null)
                            -
                        @else
                            <img src="/storage/foto_pulang/{{ $absen->pulang->foto_pulang }}" class="img-fluid mb-3 mt-3"
                                alt="foto_pulang" width="500">

                            <h6>Jam : {{ $absen->pulang->jam_pulang }}</h6>
                            <br>
                            <h6>Lokasi</h6>
                            <a href="https://www.google.com/maps/place/{{ $absen->pulang->lokasi_pulang }}" target='_blank'
                                style="color: white">{{ $absen->pulang->lokasi_pulang }}</a>

                            {{-- <div class="input-group">
                                <input type="text" id="textCopyPulang" class="form-control form-control-sm"
                                    value="{{ $absen->pulang->lokasi_pulang }}">
                                <button class="btn btn-sm btn-primary" onclick="copy('Pulang')">salin
                                    lokasi</button>
                            </div> --}}
                        @endif
                    </div>

                    {{-- izin --}}
                    {{-- @if ($absen->izin->jam_izin == null)
                    @else
                        <a href="/detailIzin/{{ $absen->izin->id }}" class="btn btn-info">Lihat izin</a>
                    @endif --}}
                </div>


            </div>
    @endforeach
@endsection
