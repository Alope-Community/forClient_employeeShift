@extends('layouts.app')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        @php
            $prefix = auth('admin')->check() ? 'admin' : (auth('shift_leader')->check() ? 'shift-leader' : null);
        @endphp
        <div class="row">
            <div class="col-md-8">
                <h3 class="fw-bold mb-4">Tambah Jadwal Shift <i class="lni lni-plus"></i></h3>

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route($prefix . '.schedule.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                                <select class="form-select" id="nama_karyawan" name="employee_id" required>
                                    <option selected disabled>Pilih karyawan</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="shift" class="form-label">Shift</label>
                                <select class="form-select" id="shift" name="shift_id" required>
                                    <option selected disabled>Pilih shift</option>
                                    @foreach ($shifts as $shift)
                                        <option value="{{ $shift->id }}">{{ $shift->name }} ({{ $shift->group }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="waktu" class="form-label">Tanggal & Waktu</label>
                                <input type="datetime-local" class="form-control" id="waktu" name="date" required>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">
                                    <i class="lni lni-arrow-left"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="lni lni-save"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
