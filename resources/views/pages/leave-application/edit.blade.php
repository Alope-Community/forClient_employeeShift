@extends('layouts.app')

@section('title', 'Edit Pengajuan Pergantian Shift')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        <h1 class="mb-4">{{ __('Edit Pengajuan Pergantian Shift') }}</h1>

        @php
            $prefix = auth('admin')->check()
                ? 'admin'
                : (auth('shift_leader')->check()
                    ? 'shift-leader'
                    : (auth('employee')->check()
                        ? 'employee'
                        : null));
        @endphp

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>{{ __('Terjadi kesalahan!') }}</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route($prefix . '.leave-application.update', $report->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="from_employee_id" class="form-label fw-bold">{{ __('Karyawan Asal') }}</label>
                <select class="form-select" id="from_employee_id" name="from_employee_id" required>
                    <option value=""></option>
                    @foreach ($employees as $employee)
                        @php
                            $todaySchedule = $employee->schedules->first();
                        @endphp
                        <option value="{{ $employee->id }}" data-schedule-id="{{ $todaySchedule->shift->id ?? '' }}"
                            {{ $report->from_employee_id == $employee->id ? 'selected' : '' }}
                            data-schedule-name="{{ $todaySchedule->shift->name ?? '-' }}">
                            {{ $employee->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="from_shift_name" class="form-label fw-bold">{{ __('Dari Shift') }}</label>
                <input type="text" id="from_shift_name" class="form-control" value="{{ $report->fromShift->name }}"
                    readonly>
                <input type="hidden" name="from_shift_id" id="from_shift_id" value="{{ $report->from_shift_id }}">
            </div>

            <div class="mb-3">
                <label for="division" class="form-label">{{ __('Divisi') }}</label>
                <select class="form-select" id="division" name="division" required>
                    <option value=""></option>
                    <option value="Unit Personnel" {{ $report->division == 'Unit Personnel' ? 'selected' : '' }}>
                        Unit Personnel
                    </option>
                    <option value="WTP Personnel" {{ $report->division == 'WTP Personnel' ? 'selected' : '' }}>
                        WTP Personnel
                    </option>
                    <option value="Ash FGD Personnel" {{ $report->division == 'Ash FGD Personnel' ? 'selected' : '' }}>
                        Ash FGD Personnel
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">{{ __('Judul') }}</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $report->title }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">{{ __('Alasan') }}</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ $report->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="time" class="form-label">{{ __('Tanggal') }}</label>
                <input type="date" name="time" id="time" class="form-control" value="{{ $report->time }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">{{ __('Alamat') }}</label>
                <textarea class="form-control" id="address" name="address" rows="2" required>{{ $report->address }}</textarea>
            </div>

            <div class="mb-3">
                <label for="to_shift_id" class="form-label">{{ __('Kepada Shift') }}</label>
                <select class="form-select" id="to_shift_id" name="to_shift_id" required>
                    <option value="">-- Pilih Shift --</option>
                    @foreach ($shifts as $shift)
                        <option value="{{ $shift->id }}" {{ $report->to_shift_id == $shift->id ? 'selected' : '' }}>
                            {{ $shift->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('Gambar Saat Ini') }}</label><br>
                @if ($report->image)
                    <img src="{{ asset('storage/' . $report->image) }}" alt="Image" width="200">
                @else
                    <p>{{ __('Tidak ada gambar.') }}</p>
                @endif
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">{{ __('Ubah Gambar') }}</label>
                <input class="form-control" type="file" id="image" name="image" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Simpan Perubahan') }}</button>
            <a href="{{ route($prefix . '.leave-application.index') }}" class="btn btn-secondary">{{ __('Batal') }}</a>
        </form>
    </div>
@endsection
