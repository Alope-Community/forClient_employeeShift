<div class="main p-3 ms-md-5 mt-3">
    @if ($schedule != null && $schedule->is_replaced)
    <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
        <strong><i class="lni lni-warning fs-5 me-2 text-warning"></i>{{ __('Perhatian!') }}</strong><br>
        {{ __('Penggajian akan disesuaikan karena terdapat pergantian shift.') }}<br>
        {{ __('Shift pada tanggal')}}<strong>{{ $schedule->date }}</strong> {{ __('telah dibackup oleh .') }}
        <strong>{{ $schedule->replacedWith->name }}</strong>.<br>
        {{ __('Pastikan informasi ini benar. Hubungi admin jika terjadi kesalahan.') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-12 col-md-8 d-flex flex-column gap-3">
            <!-- Shift Card -->
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

            <!-- Personnel Cards -->
            <div class="row g-3">
                <div class="col-12 col-md-4">
                    <div class="card shadow-lg border h-100" style="border: 2px solid #054586 !important;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <p class="card-text fs-1 fw-bold mb-0">
                                    {{ $countPerDivision['Unit Personnel'] ?? 0 }}
                                </p>
                                <h5 class="card-title mb-1">{{ __('Unit Personnel') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card shadow-lg border h-100" style="border: 2px solid #054586 !important;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <p class="card-text fs-1 fw-bold mb-0">
                                    {{ $countPerDivision['Ash FGD Personnel'] ?? 0 }}
                                </p>
                                <h5 class="card-title mb-1">{{ __('Ash FGD Personnel') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card shadow-lg border h-100" style="border: 2px solid #054586 !important;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <p class="card-text fs-1 fw-bold mb-0">
                                    {{ $countPerDivision['WTP Personnel'] ?? 0 }}
                                </p>
                                <h5 class="card-title mb-1">{{ __('WTP Personnel') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Personnel Cards -->
        </div>
    </div>
</div>