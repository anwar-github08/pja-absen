<div>
    <div class="col-md-4">
        <div class="input-group mb-4">
            <input type="text" wire:model='tanggal' id="tgl" class="form-control" placeholder="Tanggal"
                autocomplete="off">
            @if ($tanggal == '')
                <button class="btn btn-primary" wire:click='showData' disabled>Tampilkan</button>
            @else
                <button class="btn btn-primary" wire:click='showData'>Tampilkan</button>
            @endif
        </div>
    </div>

    <table class="table table-dark table-striped table-bordered table-fluid text-white text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Karyawan</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Lokasi</th>
                <th>Foto Kunjungan</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kunjungans as $kunjungan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kunjungan->karyawan->nama_karyawan }}</td>
                    <td>{{ date('d-m-Y', strtotime($kunjungan->tanggal_kunjungan)) }}</td>
                    <td>{{ $kunjungan->jam_kunjungan }}</td>
                    <td>{{ $kunjungan->lokasi_kunjungan }}</td>
                    <td><img src="/storage/foto_kunjungan/{{ $kunjungan->foto_kunjungan }}" alt="foto_kunjungan"
                            width="100"></td>
                    <td><a href="/detailKunjungan/{{ $kunjungan->id }}" target="blank"
                            class="btn btn-sm btn-info">Detail</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@push('script')
    <script>
        config = {
            mode: "range",
            maxDate: 'today',
            dateFormat: 'd-m-Y'
        };
        flatpickr("#tgl", config);

        $(document).ready(function() {
            $('.table').DataTable();
        });

        document.addEventListener("triggerJs", () => {
            Livewire.hook('element.initialized', () => {
                $('.table').DataTable();
            })
        })
    </script>
@endpush
