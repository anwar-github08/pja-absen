    <div>
        <div class="row d-flex justify-content-center">
            <div class="form">

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Nama Karyawan</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model.debounce.500ms="nama_karyawan" class="form-control"
                            placeholder="Nama Karyawan">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model.debounce.500ms="username" class="form-control"
                            placeholder="Username">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model.debounce.500ms="password" class="form-control"
                            placeholder="Password">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                        <select wire:model="jabatan_id" class="form-select">
                            <option value="-">-- pilih jabatan --</option>
                            @foreach ($jabatans as $jabatan)
                                <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Admin</label>
                    <div class="col-sm-10 form-switch">
                        <input class="form-check-input" wire:model="is_admin" type="checkbox" role="switch"
                            id="flexSwitchCheckDefault">
                    </div>
                </div>


                <div class="text-center">
                    <div wire:loading>
                        <h6>Loading...</h6>
                    </div>
                </div>

                <div class="row">
                    @if ($nama_karyawan == '' or $username == '' or $password == '' or $jabatan_id == '-')
                        <button class="btn btn-primary" wire:click='storeKaryawan' disabled>Simpan</button>
                    @else
                        <button class="btn btn-primary" wire:click='storeKaryawan'>Simpan</button>
                    @endif
                </div>

            </div>
        </div>
    </div>
