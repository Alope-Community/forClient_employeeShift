@extends('layouts.app')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        <h1 class="mb-4">{{ __('Buat Pengajuan Backup Shift') }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
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

        @if (is_null($schedule))
            <div class="alert alert-warning">
                {{ __('Jadwal Anda tidak ditemukan. Anda tidak dapat mengajukan penggantian shift.') }}
            </div>
        @else
            <div class="mb-3">
                <label class="form-label fw-bold">{{ __('Pemohon') }}</label>
                <input type="text" class="form-control" readonly value="{{ auth()->user()->name }}">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">{{ __('Jadwal Pemohon') }}</label>
                <input type="datetime" class="form-control" readonly value="{{ $schedule->date }}">
            </div>

            <form action="{{ route('employee.shift-replacement.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">{{ __('Sampai Dengan') }}</label>
                    <input type="datetime-local" class="form-control" name="end_date"
                        placeholder="Pilih tanggal dan waktu berakhir" value="{{ old('end_date') }}" required>
                    <small class="text-muted">Format: YYYY-MM-DD HH:MM (24 jam)</small>
                </div>


                <div class="mb-3">
                    <label for="replaced_with" class="form-label fw-bold">{{ __('Backup Oleh') }}</label>
                    <select class="form-select" id="replaced_with" name="replaced_with" required>
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

                <div class="mb-3">
                    <label for="from_shift_name" class="form-label fw-bold">{{ __('Shift Karyawan Asal') }}</label>
                    <input type="text" id="from_shift_name" class="form-control" readonly>
                    <input type="hidden" name="from_shift_id" id="from_shift_id">
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Kirim Pengajuan') }}</button>
            </form>
        @endif
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#replaced_with').select2();

                $('#replaced_with').on('change', function() {
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
