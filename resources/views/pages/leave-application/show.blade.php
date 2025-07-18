@extends('layouts.app')

@section('title', 'Detail Pengajuan Pergantian Shift')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        <h1 class="mb-4">{{ __('Detail Pengajuan Pergantian Shift') }}</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $shiftReport->title }}</h5>
                <h6 class="card-subtitle mb-3 text-muted">
                    {{ __('Diajukan oleh:') }} {{ $shiftReport->employee->name }} {{ __('pada') }}
                    {{ \Carbon\Carbon::parse($shiftReport->time)->translatedFormat('d M Y, H:i') }}
                </h6>

                <dl class="row">
                    <dt class="col-sm-3">{{ __('Dari Shift') }}</dt>
                    <dd class="col-sm-9">{{ $shiftReport->fromShift->name }}</dd>

                    <dt class="col-sm-3">{{ __('Ke Shift') }}</dt>
                    <dd class="col-sm-9">{{ $shiftReport->toShift->name }}</dd>

                    <dt class="col-sm-3">{{ __('Alamat') }}</dt>
                    <dd class="col-sm-9">{{ $shiftReport->address }}</dd>

                    <dt class="col-sm-3">{{ __('Divisi') }}</dt>
                    <dd class="col-sm-9">{{ $shiftReport->division ?? '-' }}</dd>

                    <dt class="col-sm-3">{{ __('Alasan') }}</dt>
                    <dd class="col-sm-9">{{ $shiftReport->description }}</dd>

                    @if ($shiftReport->image)
                        <dt class="col-sm-3">{{ __('Bukti Pendukung') }}</dt>
                        <dd class="col-sm-9">
                            <img src="{{ asset('storage/' . $shiftReport->image) }}" alt="Bukti"
                                class="img-fluid rounded" style="max-height: 300px;">
                        </dd>
                    @endif

                    @if ($shiftReport->shiftChange)
                        <dt class="col-sm-3">{{ __('Status') }}</dt>
                        <dd class="col-sm-9">
                            <span
                                class="badge 
                            @if ($shiftReport->shiftChange->status === 'approved') bg-success 
                            @elseif($shiftReport->shiftChange->status === 'rejected') bg-danger 
                            @else bg-warning text-dark @endif">
                                {{ ucfirst($shiftReport->shiftChange->status) }}
                            </span>
                        </dd>

                        <dt class="col-sm-3">{{ __('Disetujui Oleh') }}</dt>
                        <dd class="col-sm-9">{{ $shiftReport->shiftChange->approver->name ?? '-' }}</dd>

                        <dt class="col-sm-3">{{ __('Tanggal Persetujuan') }}</dt>
                        <dd class="col-sm-9">
                            {{ $shiftReport->shiftChange->approved_at ? \Carbon\Carbon::parse($shiftReport->shiftChange->approved_at)->translatedFormat('d M Y, H:i') : '-' }}
                        </dd>
                    @endif
                </dl>

                {{-- @auth('employee')
                    <a href="{{ route('employee.leave-application.index') }}"
                        class="btn btn-secondary mt-3">{{ __('Kembali') }}</a>
                    <a href="{{ route('employee.leave-application.download', $shiftReport->id) }}" class="btn btn-danger mt-3"
                        target="_blank">
                        <i class="lni lni-printer"></i> {{ __('Unduh PDF') }}
                    </a>
                @endauth
                @auth('admin')
                    <a href="{{ route('admin.leave-application.index') }}"
                        class="btn btn-secondary mt-3">{{ __('Kembali ke Daftar') }}</a>
                    <a href="{{ route('admin.leave-application.download', $shiftReport->id) }}" class="btn btn-danger mt-3"
                        target="_blank">
                        <i class="lni lni-printer"></i> {{ __('Unduh PDF') }}
                    </a>
                @endauth --}}
                
            </div>
        </div>
    </div>
@endsection
