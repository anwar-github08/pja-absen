<div>

    <div class="row d-flex justify-content-center">
        <div class="form">

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="tanggal_pulang" class="form-control" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Jam Pulang</label>
                <div class="col-sm-10">
                    <input type="text" wire:model='jam_pulang' class="form-control" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Lokasi</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="lokasi_pulang" class="form-control" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Karyawan</label>
                <div class="col-sm-10" wire:key='{{ $iteration }}' wire:ignore>
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
                    <input type="file" wire:model="foto_pulang" class="form-control">
                </div>
            </div>

            @if ($foto_pulang)
                <div class="row mb-3 text-center">
                    @error('foto_pulang')
                        <i>file harus gambar</i>
                    @else
                        <img src="{{ $foto_pulang->temporaryUrl() }}" class="img-fluid col-sm-3">
                    @enderror
                </div>
            @endif

            <div class="text-center">
                <div wire:loading>
                    <h6>Loading...</h6>
                </div>
            </div>

            <div class="row">
                @if ($foto_pulang == null or $karyawan_id == '-')
                    <button class="btn btn-two" wire:click='storePulang' disabled>Absen Pulang</button>
                @else
                    <button class="btn btn-two" wire:click='storePulang'>Absen Pulang</button>
                @endif
            </div>

        </div>
    </div>

</div>
@push('script')
    <script>
        $(document).ready(function() {
            $('.form-select').select2({
                theme: "classic",
                width: '100%'
            })
            $('.form-select').on('change', function() {
                @this.set('karyawan_id', this.value)
            })
        })
    </script>
@endpush
