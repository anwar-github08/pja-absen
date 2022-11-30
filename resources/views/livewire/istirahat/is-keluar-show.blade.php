<div class="mt-5">
    @if (session()->has('sukses'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('sukses') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-dark table-striped table-bordered table-fluid text-white text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Karyawan</th>
                <th>Jam Keluar</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($isKeluars as $isKeluar)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $isKeluar->karyawan->nama_karyawan }}</td>
                    <td>{{ $isKeluar->jam_is_keluar }}</td>
                    <td>{{ $isKeluar->lokasi_is_keluar }}</td>
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
            Livewire.hook('element.initialized', () => {
                $('.table').DataTable();
            })
        })
    </script>
@endpush
