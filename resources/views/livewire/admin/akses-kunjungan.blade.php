<div>
    <h6 class="text-center">Daftar Jabatan Untuk Akses Kunjungan</h6>
    <div class="d-flex justify-content-center">

        <div class="col-md-6 text-center mt-5">

            @if (session()->has('sukses'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ session('sukses') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <table class="table table-bordered table-light text-center form-switch mt-2">
                <thead>
                    <tr>
                        <th>Akses</th>
                        <th>Jabatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jabatans as $jabatan)
                        <tr>
                            <td> <input class="form-check-input" wire:model="jabatan_id" type="checkbox" role="switch"
                                    id="flexSwitchCheckDefault" value="{{ $jabatan->id }}"></td>
                            <td>{{ $jabatan->nama_jabatan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button class="btn btn-primary" wire:click='storeJabatanId'>Simpan</button>
        </div>

    </div>
</div>
