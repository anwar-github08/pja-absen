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
                <th>Keperluan</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($izins as $izin)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $izin->karyawan->nama_karyawan }}</td>
                    <td>{{ date('d-m-Y', strtotime($izin->tanggal_izin)) }}</td>
                    <td>{{ $izin->jam_izin }}</td>
                    <td>{{ $izin->lokasi_izin }}</td>
                    <td>{{ $izin->keperluan }}</td>
                    <td><a href="/detailIzin/{{ $izin->id }}" target="blank" class="btn btn-sm btn-info">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if (count($izins) !== 0)
        <a href="/exportExcelIzin/{{ $tanggal }}" class="btn btn-sm btn-success mt-3">Export Excel</a>
        <a href="/exportPdfIzin/{{ $tanggal }}" class="btn btn-sm btn-info mt-3">Export PDF</a>
        <button class="btn btn-danger btn-sm mt-3"
            onclick="return confirm('data akan dihapus..!!') || event.stopImmediatePropagation()"
            wire:click='deleteData'>Hapus Data</button>
    @endif
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
            Livewire.hook('message.processed', () => {
                $('.table').DataTable();
            })
        })
    </script>
@endpush
