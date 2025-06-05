@extends('layouts.app')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        @php
            $prefix = auth('admin')->check() ? 'admin' : (auth('shift_leader')->check() ? 'shift-leader' : null);
        @endphp
        <div class="row">
            <div class="col-md-8">
                <h3 class="fw-bold mb-4">{{ __('Edit Jadwal Shift')}} <i class="lni lni-pencil"></i></h3>

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route($prefix . '.schedule.update', $schedule->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama_karyawan" class="form-label">{{ __('Nama Karyawan')}}</label>
                                <select class="form-select" id="nama_karyawan" name="employee_id" required>
                                    <option disabled>Pilih karyawan</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}"
                                            {{ $employee->id == $schedule->employee_id ? 'selected' : '' }}>
                                            {{ $employee->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="shift" class="form-label">{{ __('Shift')}}</label>
                                <select class="form-select" id="shift" name="shift_id" required>
                                    <option disabled>Pilih shift</option>
                                    @foreach ($shifts as $shift)
                                        <option value="{{ $shift->id }}"
                                            {{ $shift->id == $schedule->shift_id ? 'selected' : '' }}>
                                            {{ $shift->name }} ({{ $shift->group }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="waktu" class="form-label">{{ __('Tanggal & Waktu')}}</label>
                                <input type="datetime-local"
                                       class="form-control"
                                       id="waktu"
                                       name="date"
                                       value="{{ \Carbon\Carbon::parse($schedule->shift_time)->format('Y-m-d\TH:i') }}"
                                       required>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">
                                    <i class="lni lni-arrow-left"></i> {{ __('Batal')}}
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="lni lni-save"></i> {{ __('Simpan Perubahan')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
