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
                <th>Jabatan</th>
                <th>Username</th>
                <th>Password</th>
                <th>Status Admin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($karyawans as $karyawan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $karyawan->nama_karyawan }}</td>
                    <td>{{ $karyawan->jabatan->nama_jabatan }}</td>
                    <td>{{ $karyawan->user->name }}</td>
                    <td>{{ $karyawan->user->key }}</td>
                    <td class="form-switch">
                        @if ($karyawan->user->is_admin == 0)
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                                wire:change='changeIsAdmin({{ $karyawan->user->id }},{{ $karyawan->user->is_admin }})'>
                        @else
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                                checked
                                wire:change='changeIsAdmin({{ $karyawan->user->id }},{{ $karyawan->user->is_admin }})'>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('data yang berhubungan akan dihapus..!!') || event.stopImmediatePropagation()"
                            wire:click='deleteKaryawan({{ $karyawan->id }})'>Hapus</button>
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
