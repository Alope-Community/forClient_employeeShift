@extends('layouts.app')

@section('title', 'Edit Shift')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        <h3 class="fw-bold mb-4"><i class="lni lni-pencil"></i> {{ __('Edit Shift')}}</h3>

        @php
            $prefix = auth('admin')->check() ? 'admin' : (auth('shift_leader')->check() ? 'shift-leader' : null);
        @endphp

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($prefix)
            <form action="{{ route($prefix . '.shift.update', $shift->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="namaShift" class="form-label">{{ __('Nama Shift')}}</label>
                    <input type="text" class="form-control" id="namaShift" name="name"
                        value="{{ old('name', $shift->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="grupShift" class="form-label">{{ __('Grup Shift')}}</label>
                    <input type="text" class="form-control" id="grupShift" name="group"
                        value="{{ old('group', $shift->group) }}" required>
                </div>

                <div class="mb-3">
                    <label for="jamMasuk" class="form-label">{{ __('Jam Masuk')}}</label>
                    <input type="time" class="form-control" id="jamMasuk" name="start_time"
                        value="{{ old('start_time', \Carbon\Carbon::parse($shift->start_time)->format('H:i')) }}" required>
                </div>

                <div class="mb-3">
                    <label for="jamKeluar" class="form-label">{{ __('Jam Keluar')}}</label>
                    <input type="time" class="form-control" id="jamKeluar" name="end_time"
                        value="{{ old('end_time', \Carbon\Carbon::parse($shift->end_time)->format('H:i')) }}" required>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">{{ __('Simpan Perubahan')}}</button>
                    <a href="{{ route($prefix . '.shift.index') }}" class="btn btn-secondary">{{ __('Batal')}}</a>
                </div>
            </form>
        @else
            <div class="alert alert-danger">
                {{ __('Anda tidak memiliki izin untuk mengedit shift ini.')}}
            </div>
        @endif
    </div>
@endsection
