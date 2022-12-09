<div>
    <div class="row d-flex justify-content-center">
        <div class="form">

            {{-- <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="tanggal_izin" class="form-control" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Jam Izin</label>
                <div class="col-sm-10">
                    <input type="text" wire:model='jam_izin' class="form-control" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Lokasi</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="lokasi_izin" class="form-control" disabled>
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
            </div> --}}
            @if ($isAbsen == true)
                <div class="alert alert-success text-center" role="alert">
                    <img src="/img/cat.png" class="img-fluid">
                    <strong>Izin Tersimpan</strong>
                </div>
            @else
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Keperluan</label>
                    <div class="col-sm-10">
                        <textarea wire:model='keperluan' cols="10" rows="3" class="form-control" placeholder="keperluan"></textarea>
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
            @endif

        </div>
    </div>
</div>
{{-- @push('script')
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

        document.addEventListener("triggerJs", () => {
            Livewire.hook('element.initialized', () => {
                $('.form-select').select2({
                    theme: "classic",
                    width: '100%'
                })
                $('.form-select').on('change', function() {
                    @this.set('karyawan_id', this.value)
                })
            })
        })
    </script>
@endpush --}}
