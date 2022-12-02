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
                <th>Jabatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jabatans as $jabatan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $jabatan->nama_jabatan }}</td>
                    <td>
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('data yang berhubungan akan dihapus..!!') || event.stopImmediatePropagation()"
                            wire:click='deleteJabatan({{ $jabatan->id }})'>Hapus</button>
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
