@extends('layouts.app')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        @php
            $prefix = auth('admin')->check() ? 'admin' : (auth('shift_leader')->check() ? 'shift-leader' : null);
        @endphp
        <h3 class="fw-bold mb-4">{{ __('Verifikasi Pergantian Shift')}}</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route($prefix . '.shift-change.update', $shiftChange->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="namaKaryawan" class="form-label">{{ __('Nama Karyawan Asal') }}</label>
                        <input readonly ="text" class="form-control" id="namaKaryawan"
                            value="{{ $shiftChange->shiftReport->fromEmployee->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="dariShift" class="form-label">{{ __('Dari Shift')}}</label>
                        <input readonly type="text" class="form-control" id="dariShift"
                            value="{{ $shiftChange->shiftReport->fromShift->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="namaKaryawan" class="form-label">{{ __('Nama Karyawan') }}</label>
                        <input readonly ="text" class="form-control" id="namaKaryawan"
                            value="{{ $shiftChange->shiftReport->employee->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="keShift" class="form-label">{{ __('Ke Shift') }}</label>
                        <input readonly type="text" class="form-control" id="keShift"
                            value="{{ $shiftChange->shiftReport->toShift->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="judul" class="form-label">{{ __('Judul')}}</label>
                        <input readonly type="text" class="form-control" id="judul"
                            value="{{ $shiftChange->shiftReport->title }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">{{ __('Deskripsi')}}</label>
                        <textarea class="form-control" id="deskripsi" rows="3" readonly>{{ $shiftChange->shiftReport->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="waktu" class="form-label">{{ __('Waktu')}}</label>
                        <input readonly type="text" class="form-control" id="waktu"
                            value="{{ $shiftChange->shiftReport->time }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">{{ __('Alamat')}}</label>
                        <textarea class="form-control" id="alamat" rows="2" readonly>{{ $shiftChange->shiftReport->address }}</textarea>
                    </div>

                    @if ($shiftChange->shiftReport->image)
                        <div class="mb-3">
                            <label class="form-label">{{ __('Gambar')}}</label>
                            <div>
                                <img src="{{ asset('storage/' . $shiftChange->shiftReport->image) }}"
                                    alt="Gambar Shift Report" class="img-fluid rounded" style="max-height: 300px;">
                            </div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="status" class="form-label">{{ __('Status Persetujuan')}}</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="approved" {{ $shiftChange->status === 'approved' ? 'selected' : '' }}>{{ __('Disetujui')}}
                            </option>
                            <option value="rejected" {{ $shiftChange->status === 'rejected' ? 'selected' : '' }}>{{ __('Ditolak')}}
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="approved_at" class="form-label">{{ __('Waktu Persetujuan')}}</label>
                        <input readonly type="datetime-local" name="approved_at" id="approved_at" class="form-control"
                            value="{{ $shiftChange->approved_at ? \Carbon\Carbon::parse($shiftChange->approved_at)->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i') }}"
                            required>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('Simpan')}}</button>
                    <a href="{{ route($prefix . '.shift-change.index') }}" class="btn btn-secondary ms-2">{{ __('Batal')}}</a>
                </form>
            </div>
        </div>
    </div>
@endsection
