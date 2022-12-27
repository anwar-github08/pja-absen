<div>
    <div class="row d-flex justify-content-center">
        <div class="form">

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <input type="file" wire:model="foto_kunjungan" class="form-control form-control-sm">
                </div>
            </div>

            @if ($foto_kunjungan)
                <div class="row mb-3 text-center">
                    @error('foto_kunjungan')
                        <i>file harus gambar</i>
                    @else
                        <img src="{{ $foto_kunjungan->temporaryUrl() }}" class="img-fluid col-sm-3">
                    @enderror
                </div>
            @endif

            <div class="text-center">
                <div wire:loading>
                    <h6>Loading...</h6>
                </div>
            </div>

            <div class="row">
                @if ($foto_kunjungan == null)
                    <button class="btn btn-two" wire:click='storeKunjungan' disabled>Absen Kunjungan</button>
                @else
                    <button class="btn btn-two" wire:click='storeKunjungan'>Absen Kunjungan</button>
                @endif
            </div>
            {{-- @endif --}}

        </div>
    </div>
</div>
@push('script')
    <script language="JavaScript" src="/js/geoLocation.js?n=5"></script>
@endpush
