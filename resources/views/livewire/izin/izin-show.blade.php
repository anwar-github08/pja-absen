<div class="mt-2">
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
                <th>Jam izin</th>
                <th>Lokasi</th>
                <th>Keperluan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($izins as $izin)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $izin->karyawan->nama_karyawan }}</td>
                    <td>{{ $izin->jam_izin }}</td>
                    <td>
                        <a style="color: white" href="https://www.google.com/maps/place/{{ $izin->lokasi_izin }}"
                            target="_blank">
                            {{ $izin->lokasi_izin }}</a>
                    </td>
                    <td>{{ $izin->keperluan }}</td>
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
