@extends('layouts.app')

@section('title', 'Edit Pengajuan Pergantian Shift')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        <h1 class="mb-4">{{ __('Edit Pengajuan Pergantian Shift')}}</h1>

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
                <strong>{{ __('Terjadi kesalahan!')}}</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route($prefix . '.report-problem.update', $report->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">{{ __('Judul')}}</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $report->title }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">{{ __('Alasan')}}</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ $report->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="time" class="form-label">{{ __('Tanggal') }}</label>
                <input type="date" name="time" id="time" class="form-control"
                    value="{{ $report->time }}" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">{{ __('Alamat')}}</label>
                <textarea class="form-control" id="address" name="address" rows="2" required>{{ $report->address }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('Gambar Saat Ini')}}</label><br>
                @if ($report->image)
                    <img src="{{ asset('storage/' . $report->image) }}" alt="Image" width="200">
                @else
                    <p>{{ __('Tidak ada gambar.')}}</p>
                @endif
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">{{ __('Ubah Gambar')}}</label>
                <input class="form-control" type="file" id="image" name="image" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Simpan Perubahan')}}</button>
            <a href="{{ route($prefix . '.report-problem.index') }}" class="btn btn-secondary">{{ __('Kembali')}}</a>
        </form>
    </div>
@endsection
