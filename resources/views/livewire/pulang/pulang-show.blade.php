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
                <th>Jam Pulang</th>
                <th>Lokasi</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pulangs as $pulang)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pulang->karyawan->nama_karyawan }}</td>
                    <td>{{ $pulang->jam_pulang }}</td>
                    <td>
                        <a style="color: white" href="https://www.google.com/maps/place/{{ $pulang->lokasi_pulang }}"
                            target="_blank">
                            {{ $pulang->lokasi_pulang }}</a>
                    </td>
                    <td>
                        <img src="/storage/foto_pulang/{{ $pulang->foto_pulang }}" alt="foto_pulang" width="70">
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
        })

        document.addEventListener("triggerJs", () => {
            Livewire.hook('element.initialized', () => {
                $('.table').DataTable();
            })
        })
    </script>
@endpush
