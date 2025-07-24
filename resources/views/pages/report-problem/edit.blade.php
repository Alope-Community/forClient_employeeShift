@extends('layouts.app')

@section('title', 'Edit Pengajuan Pergantian Shift')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        <h1 class="mb-4">{{ __('Edit Pengajuan Permasalahan Shift') }}</h1>

        @php
            $prefix = auth('admin')->check()
                ? 'admin'
                : (auth('shift_leader')->check()
                    ? 'shift-leader'
                    : (auth('employee')->check()
                        ? 'employee'
                        : null));

            $updateRoute =
                $prefix === 'shift-leader'
                    ? $prefix . '.report-problem.update-leader'
                    : $prefix . '.report-problem.update';
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

        @if (session('warningRequest') && !$errors->any())
            <div class="alert alert-warning">
                <ul class="mb-0">
                    {{ session('warningRequest') }}
                </ul>
            </div>
        @endif

        <form action="{{ route($updateRoute, $report->shiftChange->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-bold">{{ __('Pemohon') }}</label>
                <input type="text" class="form-control" readonly value="{{ auth()->user()->name }}">
            </div>

            @php
                $noSchedule = $schedule == null;
            @endphp
            @if (!$noSchedule)
                <div class="mb-3">
                    <label class="form-label fw-bold">{{ __('Dari Shift') }}</label>
                    <input type="text" name="from_employee_id" class="form-control" readonly
                        value="{{ $schedule->shift->name }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">{{ __('Divisi') }}</label>
                    <input type="text" name="division" class="form-control" readonly
                        value="{{ $schedule->shift->group }}">
                </div>
            @else
                <div class="alert alert-warning" role="alert">
                    <strong>Perhatian:</strong> Saat ini Anda tidak memiliki jadwal kerja, jadi Anda tidak dapat mengajukan
                    permasalahan shift.
                </div>
            @endif

            <div class="mb-3">
                <label for="title" class="form-label">{{ __('Judul') }}</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $report->title }}"
                    required {{ $prefix != 'employee' ? 'readonly' : '' }}>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">{{ __('Alasan') }}</label>
                <textarea class="form-control" id="description" name="description" rows="4" required
                    {{ $prefix != 'employee' ? 'readonly' : '' }}>{{ $report->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="time" class="form-label">{{ __('Tanggal') }}</label>
                <input type="datetime" name="time" id="time" class="form-control" value="{{ $report->time }}"
                    required {{ $prefix != 'employee' ? 'readonly' : '' }}>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">{{ __('Alamat') }}</label>
                <textarea class="form-control" id="address" name="address" rows="2" required
                    {{ $prefix != 'employee' ? 'readonly' : '' }}>{{ $report->address }}</textarea>
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
                <input class="form-control" type="file" id="image" name="image" accept="image/*"
                    {{ $prefix != 'employee' ? 'readonly' : '' }}>
            </div>

            @if ($prefix != 'employee')
                <div class="mb-3">
                    <label for="status" class="form-label">{{ __('Status Persetujuan') }}</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="approved" {{ $report->shiftChange->status === 'approved' ? 'selected' : '' }}>
                            {{ __('Disetujui') }}
                        </option>
                        <option value="rejected" {{ $report->shiftChange->status === 'rejected' ? 'selected' : '' }}>
                            {{ __('Ditolak') }}
                        </option>
                    </select>
                </div>
            @endif

            <button type="submit" class="btn btn-primary">{{ __('Simpan Perubahan') }}</button>
            <a href="{{ route($prefix . '.report-problem.index') }}" class="btn btn-secondary">{{ __('Kembali') }}</a>
        </form>
    </div>
@endsection
