@extends('layouts.app')

@section('title', 'Edit Pengajuan Cuti')

@section('content')
    <div class="main p-3 ms-3 mt-3">
        <h1 class="mb-4">Edit Pengajuan Cuti</h1>

        @php
            $prefix = auth('admin')->check() ? 'admin' : (auth('shift_leader')->check() ? 'shift-leader' : null);
        @endphp

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route($prefix . '.leave-application.update', $report->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="from_shift_id" class="form-label">Dari Shift</label>
                <select class="form-select" id="from_shift_id" name="from_shift_id" required>
                    <option value="">-- Pilih Shift --</option>
                    @foreach ($shifts as $shift)
                        <option value="{{ $shift->id }}" {{ $report->from_shift_id == $shift->id ? 'selected' : '' }}>
                            {{ $shift->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="to_shift_id" class="form-label">Kepada Shift</label>
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
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $report->title }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Alasan</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ $report->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <textarea class="form-control" id="address" name="address" rows="2" required>{{ $report->address }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Saat Ini</label><br>
                @if ($report->image)
                    <img src="{{ asset('storage/' . $report->image) }}" alt="Image" width="200">
                @else
                    <p>Tidak ada gambar.</p>
                @endif
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Ubah Gambar</label>
                <input class="form-control" type="file" id="image" name="image" accept="image/*">
            </div>

            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route($prefix . '.leave-application.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
