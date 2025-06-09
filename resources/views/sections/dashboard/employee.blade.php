<div class="row">
    <div class="col-12 col-md-8 gap-5 d-flex flex-column">
        <div class="card shadow-lg border" style="border: 2px solid #054586 !important;">
            <div class="card-body d-flex align-items-center">
                <div class="bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                    style="width: 50px; height: 50px; background-color: #054586;">
                    <i class="lni lni-alarm fs-4 text-white"></i>
                </div>
                <div>
                    <h5 class="card-title mb-1">{{ __('Shift Saat Ini') }}</h5>
                    <p class="card-text text-muted mb-0">
                        @if ($schedule != null)
                            {{ $schedule->shift->name }}
                            ({{ \Carbon\Carbon::parse($schedule->shift->start_time)->format('H:i') }} -
                            {{ \Carbon\Carbon::parse($schedule->shift->end_time)->format('H:i') }})
                        @else
                            {{ __('Tidak ada jadwal hari ini.') }}
                        @endif

                    </p>
                </div>
            </div>
        </div>
        <div class="d-flex gap-5">

            <div class="card shadow-lg border px-5" style="border: 2px solid #054586 !important;">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <p class="card-text fs-1 fw-bold mb-0 text-center">
                            {{ $countPerDivision['Unit Personnel'] ?? 0 }}
                        </p>
                        <h5 class="card-title mb-1">{{ __('Unit Personnel') }}</h5>
                    </div>
                </div>
            </div>

            <div class="card shadow-lg border px-5" style="border: 2px solid #054586 !important;">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <p class="card-text fs-1 fw-bold mb-0 text-center">
                            {{ $countPerDivision['Ash FGD Personnel'] ?? 0 }}
                        </p>
                        <h5 class="card-title mb-1">{{ __('Ash FGD Personnel') }}</h5>
                    </div>
                </div>
            </div>
            
            <div class="card shadow-lg border px-5" style="border: 2px solid #054586 !important;">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <p class="card-text fs-1 fw-bold mb-0 text-center">
                            {{ $countPerDivision['WTP Personnel'] ?? 0 }}
                        </p>
                        <h5 class="card-title mb-1">{{ __('WTP Personnel') }}</h5>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
