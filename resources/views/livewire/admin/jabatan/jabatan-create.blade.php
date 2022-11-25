<div>
    <div class="row d-flex justify-content-center">
        <div class="form">

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Jabatan</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="nama_jabatan" class="form-control" placeholder="Nama Jabatan">
                </div>
            </div>

            <div class="text-center">
                <div wire:loading>
                    <h6>Loading...</h6>
                </div>
            </div>

            <div class="row">
                @if ($nama_jabatan == '')
                    <button class="btn btn-primary" wire:click='storeJabatan' disabled>Simpan</button>
                @else
                    <button class="btn btn-primary" wire:click='storeJabatan'>Simpan</button>
                @endif
            </div>

        </div>
    </div>
</div>
