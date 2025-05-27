@extends('layouts.app')

@section('title', 'Detail Pengajuan Pergantian Shift')

@section('content')
    <div class="main p-3 ms-3 mt-3">
        <h1 class="mb-4">Detail Riwayat Pengajuan Pergantian Shift</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $report->title }}</h5>
                <h6 class="card-subtitle mb-3 text-muted">
                    Diajukan oleh: {{ $report->employee->name }} pada
                    {{ \Carbon\Carbon::parse($report->time)->translatedFormat('d M Y, H:i') }}
                </h6>

                <dl class="row">
                    <dt class="col-sm-3">Dari Shift</dt>
                    <dd class="col-sm-9">{{ $report->fromShift->name }}</dd>

                    <dt class="col-sm-3">Ke Shift</dt>
                    <dd class="col-sm-9">{{ $report->toShift->name }}</dd>

                    <dt class="col-sm-3">Alamat</dt>
                    <dd class="col-sm-9">{{ $report->address }}</dd>

                    <dt class="col-sm-3">Alasan</dt>
                    <dd class="col-sm-9">{{ $report->description }}</dd>

                    @if ($report->image)
                        <dt class="col-sm-3">Bukti Pendukung</dt>
                        <dd class="col-sm-9">
                            <img src="{{ asset('storage/' . $report->image) }}" alt="Bukti"
                                class="img-fluid rounded" style="max-height: 300px;">
                        </dd>
                    @endif

                    @if ($report->shiftChange)
                        <dt class="col-sm-3">Status</dt>
                        <dd class="col-sm-9">
                            <span
                                class="badge 
                            @if ($report->shiftChange->status === 'approved') bg-success 
                            @elseif($report->shiftChange->status === 'rejected') bg-danger 
                            @else bg-warning text-dark @endif">
                                {{ ucfirst($report->shiftChange->status) }}
                            </span>
                        </dd>

                        <dt class="col-sm-3">Disetujui Oleh</dt>
                        <dd class="col-sm-9">{{ $report->shiftChange->approver->name ?? '-' }}</dd>

                        <dt class="col-sm-3">Tanggal Persetujuan</dt>
                        <dd class="col-sm-9">
                            {{ $report->shiftChange->approved_at ? \Carbon\Carbon::parse($report->shiftChange->approved_at)->translatedFormat('d M Y, H:i') : '-' }}
                        </dd>
                    @endif
                </dl>
                <a href="{{ route('employee.shift-history.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
