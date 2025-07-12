@extends('layouts.app')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        <h1 class="mb-4">{{ __('Buat Pengajuan Shift') }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label fw-bold">{{ __('Pemohon Shift') }}</label>
            <input type="text" class="form-control" readonly value="{{ auth()->user()->name }}">
        </div>

        <form action="{{ route('employee.leave-application.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Select Input -->
            <div class="mb-3">
                <label for="from_employee_id" class="form-label fw-bold">{{ __('Pengganti Shift') }}</label>
                <select class="form-select" id="from_employee_id" name="from_employee_id" required>
                    <option value=""></option>
                    @foreach ($employees as $employee)
                        @php
                            $todaySchedule = $employee->schedules->first();
                        @endphp
                        <option value="{{ $employee->id }}" data-schedule-id="{{ $todaySchedule->shift->id ?? '' }}"
                            data-schedule-name="{{ $todaySchedule->shift->name ?? '-' }}">
                            {{ $employee->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Readonly Input Shift -->
            <div class="mb-3">
                <label for="from_shift_name" class="form-label fw-bold">{{ __('Shift Karyawan Asal') }}</label>
                <input type="text" id="from_shift_name" class="form-control" readonly>
                <input type="hidden" name="from_shift_id" id="from_shift_id">
            </div>


            <div class="mb-3">
                <label for="to_shift_id" class="form-label fw-bold">{{ __('Shift Tujuan') }}</label>
                <select name="to_shift_id" id="to_shift_id" class="form-select" required>
                    <option value=""></option>
                    @foreach ($shifts as $shift)
                        <option value="{{ $shift->id }}">
                            {{ $shift->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">{{ __('Judul') }}</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">{{ __('Deskripsi') }}</label>
                <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="time" class="form-label">{{ __('Tanggal') }}</label>
                <input type="date" name="time" id="time" class="form-control"
                    value="{{ old('time', now()->format('Y-m-d')) }}" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">{{ __('Alamat') }}</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="division" class="form-label fw-bold">{{ __('Divisi') }}</label>
                <select name="division" id="division" class="form-select" required>
                    <option value=""></option>
                    <option value="Unit Personnel">
                        Unit Personnel
                    </option>
                    <option value="WTP Personnel">
                        WTP Personnel
                    </option>
                    <option value="Ash FGD Personnel">
                        Ash FGD Personnel
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">{{ __('Upload Bukti') }}</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Kirim Pengajuan') }}</button>
            <a href="{{ route('employee.leave-application.index') }}" class="btn btn-secondary">{{ __('Kembali') }}</a>
        </form>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#from_employee_id').select2();

                $('#from_employee_id').on('change', function() {
                    let selected = $(this).find('option:selected');
                    let scheduleName = selected.data('schedule-name');
                    let scheduleId = selected.data('schedule-id');

                    $('#from_shift_name').val(scheduleName || '-');
                    $('#from_shift_id').val(scheduleId || '');
                });
            });
        </script>
    @endpush

@endsection
