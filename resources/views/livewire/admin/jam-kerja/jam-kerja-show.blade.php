<div class="mt-5">
    @if (session()->has('sukses'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('sukses') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="text-center">
        <div wire:loading>
            <h6>Loading...</h6>
        </div>
    </div>

    <table class="table table-dark table-striped table-bordered table-fluid text-white text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jam Kerja</th>
                <th>Datang</th>
                <th>Ist Keluar</th>
                <th>Ist Masuk</th>
                <th>Pulang</th>
                <th>Sebelum Datang</th>
                <th>Setelah Datang</th>
                <th>Sebelum Istirahat</th>
                <th>Setelah Istirahat</th>
                <th>Sebelum Pulang</th>
                <th>Setelah Pulang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jam_kerjas as $jam_kerja)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $jam_kerja->nama_jam_kerja }}</td>
                    <td>{{ $jam_kerja->jam_datang }}</td>
                    <td>{{ $jam_kerja->jam_is_keluar }}</td>
                    <td>{{ $jam_kerja->jam_is_masuk }}</td>
                    <td>{{ $jam_kerja->jam_pulang }}</td>
                    <td>{{ $jam_kerja->jam_sebelum_datang }}</td>
                    <td>{{ $jam_kerja->jam_setelah_datang }}</td>
                    <td>{{ $jam_kerja->jam_sebelum_istirahat }}</td>
                    <td>{{ $jam_kerja->jam_setelah_istirahat }}</td>
                    <td>{{ $jam_kerja->jam_sebelum_pulang }}</td>
                    <td>{{ $jam_kerja->jam_setelah_pulang }}</td>
                    <td>
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('data yang berhubungan akan dihapus..!!') || event.stopImmediatePropagation()"
                            wire:click='deleteJamKerja({{ $jam_kerja->id }})'>Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('script')
    <script>
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
