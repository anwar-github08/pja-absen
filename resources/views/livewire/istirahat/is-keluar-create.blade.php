<div>
    <div class="row d-flex justify-content-center">
        <div class="form">

            @if ($isAbsen == true)
                <div class="alert alert-warning text-center" role="alert">
                    <img src="/img/cat.png" class="img-fluid">
                    <strong>Sudah Absen Istirahat Keluar</strong>
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
@push('script')
    <script language="JavaScript" src="/js/geoLocation.js?n=5"></script>
@endpush
