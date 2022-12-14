<div>
    <div class="row d-flex justify-content-center">
        <div class="form">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama Jam Kerja</label>
                <div class="col-sm-10">
                    <input type="text" wire:model.debounce.500ms="nama_jam_kerja" class="form-control"
                        placeholder="Nama Jam Kerja">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Jam Datang</label>
                        <div class="col-sm-8">
                            <input type="text" wire:model.debounce.500ms="jam_datang" class="time form-control"
                                placeholder="Jam Datang">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Jam Istirahat Keluar</label>
                        <div class="col-sm-8">
                            <input type="text" wire:model.debounce.500ms="jam_is_keluar" class="time form-control"
                                placeholder="Jam Istirahat Keluar">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Jam Istirahat Masuk</label>
                        <div class="col-sm-8">
                            <input type="text" wire:model.debounce.500ms="jam_is_masuk" class="time form-control"
                                placeholder="Jam Istirahat Masuk">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Jam Pulang</label>
                        <div class="col-sm-8">
                            <input type="text" wire:model.debounce.500ms="jam_pulang" class="time form-control"
                                placeholder="Jam Pulang">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label">Toleransi Sebelum Datang</label>
                        <div class="col-sm-8">
                            <input type="text" wire:model.debounce.500ms="jam_sebelum_datang"
                                class="time form-control" placeholder="Toleransi Sebelum Datang">
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="row mb-3">
                        <label class="col-sm-6 col-form-label">Toleransi Setelah Datang</label>
                        <div class="col-sm-6">
                            <input type="text" wire:model.debounce.500ms="jam_setelah_datang"
                                class="time form-control" placeholder="Toleransi Setelah Datang">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-6 col-form-label">Toleransi Sebelum Istirahat</label>
                        <div class="col-sm-6">
                            <input type="text" wire:model.debounce.500ms="jam_sebelum_istirahat"
                                class="time form-control" placeholder="Toleransi Sebelum Istirahat">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-6 col-form-label">Toleransi Setelah Istirahat</label>
                        <div class="col-sm-6">
                            <input type="text" wire:model.debounce.500ms="jam_setelah_istirahat"
                                class="time form-control" placeholder="Toleransi Setelah Istirahat">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-6 col-form-label">Toleransi Sebelum Pulang</label>
                        <div class="col-sm-6">
                            <input type="text" wire:model.debounce.500ms="jam_sebelum_pulang"
                                class="time form-control" placeholder="Toleransi Sebelum Pulang">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-6 col-form-label">Toleransi Setelah Pulang</label>
                        <div class="col-sm-6">
                            <input type="text" wire:model.debounce.500ms="jam_setelah_pulang"
                                class="time form-control" placeholder="Toleransi Setelah Pulang">
                        </div>
                    </div>

                </div>

            </div>

            <div class="text-center">
                <div wire:loading>
                    <h6>Loading...</h6>
                </div>
            </div>

            <div class="row">
                @if ($nama_jam_kerja == '' or
                    $jam_datang == '' or
                    $jam_is_keluar == '' or
                    $jam_is_masuk == '' or
                    $jam_pulang == '' or
                    $jam_sebelum_datang == '' or
                    $jam_setelah_datang == '' or
                    $jam_sebelum_istirahat == '' or
                    $jam_setelah_istirahat == '' or
                    $jam_sebelum_pulang == '' or
                    $jam_setelah_pulang == '')
                    <button class="btn btn-primary" wire:click='storeJamKerja' disabled>Simpan</button>
                @else
                    <button class="btn btn-primary" wire:click='storeJamKerja'>Simpan</button>
                @endif
            </div>

        </div>
    </div>
</div>

@push('script')
    <script>
        config = {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        };
        flatpickr(".time", config);
    </script>
@endpush
