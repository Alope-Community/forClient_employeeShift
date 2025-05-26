@extends('layouts.app')

@section('content')
    @php
        $prefix = Auth::guard('admin')->check() ? 'admin' : 'shift-leader';
    @endphp

    <div class="main p-3 ms-3 mt-3">
        <div class="row">
            <div class="col-md-8">
                <h3 class="fw-bold mb-4">Detail Jadwal Shift <i class="lni lni-calendar"></i></h3>

                <div class="card">
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">Nama Karyawan</dt>
                            <dd class="col-sm-8">{{ $schedule->employee->name ?? '-' }}</dd>

                            <dt class="col-sm-4">Shift</dt>
                            <dd class="col-sm-8">
                                @if ($schedule->shift)
                                    {{ $schedule->shift->name }}
                                    ({{ \Carbon\Carbon::parse($schedule->shift->start_time)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($schedule->shift->end_time)->format('H:i') }})
                                @else
                                    -
                                @endif
                            </dd>

                            <dt class="col-sm-4">Tanggal & Waktu</dt>
                            <dd class="col-sm-8">
                                {{ \Carbon\Carbon::parse($schedule->date)->format('d M Y H:i') }}
                            </dd>
                        </dl>

                        <a href="{{ route($prefix . '.schedule.index') }}" class="btn btn-secondary mt-3">
                            <i class="lni lni-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
