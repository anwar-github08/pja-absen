<div>
    <div class="row d-flex justify-content-center">
        <div class="form">

            {{-- <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="tanggal_is_keluar" class="form-control" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Jam Keluar</label>
                <div class="col-sm-10">
                    <input type="text" wire:model='jam_is_keluar' class="form-control" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Lokasi</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="lokasi_is_keluar" class="form-control" disabled>
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
            {{-- 
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Jam Keluar</label>
                <div class="col-sm-10">
                    <input type="text" wire:model='jam_is_keluar' id="tgl" class="form-control"
                        placeholder="jam keluar">
                </div>
            </div> --}}
            @if ($isAbsen == true)
                <div class="alert alert-success text-center" role="alert">
                    <img src="/img/cat.png" class="img-fluid">
                    <strong>Sudah Absen</strong>
                </div>
            @else
                <div class="text-center">
                    <div wire:loading>
                        <h6>Loading...</h6>
                    </div>
                </div>

                <div class="row">
                    <button class="btn btn-two" wire:click='storeIsKeluar'>Absen Istirahat Keluar</button>
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
