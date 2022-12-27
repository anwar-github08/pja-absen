<div>
    <div class="row d-flex justify-content-center">
        <div class="form">

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Keperluan</label>
                <div class="col-sm-10">
                    <textarea wire:model='keperluan' cols="10" rows="3" class="form-control form-control-sm"
                        placeholder="Tulis keperluan disini.."></textarea>
                </div>
            </div>

            <div class="text-center">
                <div wire:loading>
                    <h6>Loading...</h6>
                </div>
            </div>

            <div class="row">
                @if ($keperluan == '')
                    <button class="btn btn-two" wire:click='storeIzin' disabled>Izin</button>
                @else
                    <button class="btn btn-two" wire:click='storeIzin'>Izin</button>
                @endif
            </div>
            {{-- @endif --}}

        </div>
    </div>
</div>
@push('script')
    <script language="JavaScript" src="/js/geoLocation.js?n=5"></script>
@endpush
