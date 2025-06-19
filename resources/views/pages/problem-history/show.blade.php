@extends('layouts.app')

@section('title', 'Detail Pengajuan Pergantian Shift')

@section('content')
    @php
        $prefix = auth('admin')->check() ? 'admin' : (auth('shift_leader')->check() ? 'shift-leader' : 'employee');
    @endphp

    <div class="main p-3 ms-5 mt-3">
        <h1 class="mb-4">{{ __('Detail Riwayat Pengajuan Pergantian Shift') }}</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $report->title }}</h5>
                <h6 class="card-subtitle mb-3 text-muted">
                    {{ __('Diajukan oleh:') }} {{ $report->fromEmployee->name }} {{ __('pada') }}
                    {{ \Carbon\Carbon::parse($report->time)->translatedFormat('d M Y, H:i') }}
                </h6>

                <dl class="row">
                    <dt class="col-sm-3">{{ __('Dari Shift') }}</dt>
                    <dd class="col-sm-9">{{ $report->fromShift->name }}</dd>

                    <dt class="col-sm-3">{{ __('Ke Shift') }}</dt>
                    <dd class="col-sm-9">{{ $report->toShift->name }}</dd>

                    <dt class="col-sm-3">{{ __('Alamat') }}</dt>
                    <dd class="col-sm-9">{{ $report->address }}</dd>

                    <dt class="col-sm-3">{{ __('Alasan') }}</dt>
                    <dd class="col-sm-9">{{ $report->description }}</dd>

                    @if ($report->image)
                        <dt class="col-sm-3">{{ __('Bukti Pendukung') }}</dt>
                        <dd class="col-sm-9">
                            <img src="{{ asset('storage/' . $report->image) }}" alt="Bukti" class="img-fluid rounded"
                                style="max-height: 300px;">
                        </dd>
                    @endif

                    @if ($report->shiftChange)
                        <dt class="col-sm-3">{{ __('Status') }}</dt>
                        <dd class="col-sm-9">
                            <span
                                class="badge 
                            @if ($report->shiftChange->status === 'approved') bg-success 
                            @elseif($report->shiftChange->status === 'rejected') bg-danger 
                            @else bg-warning text-dark @endif">
                                {{ ucfirst($report->shiftChange->status) }}
                            </span>
                        </dd>

                        <dt class="col-sm-3">{{ __('Disetujui Oleh') }}</dt>
                        <dd class="col-sm-9">{{ $report->shiftChange->approver->name ?? '-' }}</dd>

                        <dt class="col-sm-3">{{ __('Tanggal Persetujuan') }}</dt>
                        <dd class="col-sm-9">
                            {{ $report->shiftChange->approved_at ? \Carbon\Carbon::parse($report->shiftChange->approved_at)->translatedFormat('d M Y, H:i') : '-' }}
                        </dd>
                    @endif
                </dl>

                <a href="{{ route($prefix . '.shift-history.index') }}"
                    class="btn btn-secondary mt-3">{{ __('Kembali') }}</a>

                @if ($report->shiftChange->status === 'approved')
                    @auth('employee')
                        <a href="{{ route('employee.shift-history.download', $report->id) }}" class="btn btn-danger mt-3"
                            target="_blank">
                            <i class="lni lni-printer"></i> {{ __('Unduh PDF') }}
                        </a>
                    @endauth
                    @auth('admin')
                        <a href="{{ route('admin.shift-history.download', $report->id) }}" class="btn btn-danger mt-3"
                            target="_blank">
                            <i class="lni lni-printer"></i> {{ __('Unduh PDF') }}
                        </a>
                    @endauth
                @endif

            </div>
        </div>
    </div>
@endsection
