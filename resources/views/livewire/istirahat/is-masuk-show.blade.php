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
                <th>Jam Istirahat Masuk</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($isMasuks as $isMasuk)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $isMasuk->karyawan->nama_karyawan }}</td>
                    <td>{{ $isMasuk->jam_is_masuk }}</td>
                    <td>
                        <a style="color: white" href="https://www.google.com/maps/place/{{ $isMasuk->lokasi_is_masuk }}"
                            target="_blank">
                            {{ $isMasuk->lokasi_is_masuk }}</a>
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
