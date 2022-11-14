<div>
    <div class="row d-flex justify-content-center">
        <div class="form-datang">

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="tanggal_datang" class="form-control" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Jam</label>
                <div class="col-sm-10">
                    <input type="text" wire:model='jam_datang' class="form-control" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Lokasi</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="lokasi_datang" class="form-control" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Karyawan</label>
                <div class="col-sm-10">
                    <select wire:model="karyawan_id" id="" class="form-select">
                        <option value="-">-- pilih karyawan --</option>
                        @foreach ($karyawans as $karyawan)
                            <option value="{{ $karyawan->id }}">{{ $karyawan->nama_karyawan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <input type="file" wire:model="foto_datang" class="form-control" id="img"
                        onchange="previewImage()">
                </div>
            </div>
            <div class="row mb-3">
                <img class="img-preview img-fluid col-sm-3" wire:model='img'>
            </div>

            <div class="row">
                @if ($foto_datang == null or $karyawan_id == '-')
                    <button class="btn btn-primary" wire:click='storeDatang' disabled>Absen</button>
                @else
                    <button class="btn btn-primary" wire:click='storeDatang'>Absen</button>
                @endif
            </div>

        </div>
    </div>
</div>
