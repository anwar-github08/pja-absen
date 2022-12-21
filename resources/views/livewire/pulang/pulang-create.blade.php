<div>

    <div class="row d-flex justify-content-center">
        <div class="form">

            @if ($isAbsen == true)
                <div class="alert alert-success text-center" role="alert">
                    <img src="/img/cat.png" class="img-fluid">
                    <strong>Sudah Absen</strong>
                </div>
            @else
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
                    @if ($foto_pulang == null)
                        <button class="btn btn-two" wire:click='storePulang' disabled>Absen Pulang</button>
                    @else
                        <button class="btn btn-two" wire:click='storePulang'>Absen Pulang</button>
                    @endif
                </div>
            @endif

        </div>
    </div>

</div>
@push('script')
    <script language="JavaScript" src="/js/geoLocation.js?n=2"></script>
@endpush
