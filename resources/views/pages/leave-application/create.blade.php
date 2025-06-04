@extends('layouts.app')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        <h1 class="mb-4">{{ __('Buat Pengajuan Shift')}}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employee.leave-application.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="from_shift_id" class="form-label">{{ __('Shift Asal')}}</label>
                <select name="from_shift_id" id="from_shift_id" class="form-select" required>
                    <option value="">-- Pilih Shift Asal --</option>
                    @foreach ($shifts as $shift)
                        <option value="{{ $shift->id }}" {{ old('from_shift_id') == $shift->id ? 'selected' : '' }}>
                            {{ $shift->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="to_shift_id" class="form-label">{{ __('Shift Tujuan')}}</label>
                <select name="to_shift_id" id="to_shift_id" class="form-select" required>
                    <option value="">-- Pilih Shift Tujuan --</option>
                    @foreach ($shifts as $shift)
                        <option value="{{ $shift->id }}" {{ old('to_shift_id') == $shift->id ? 'selected' : '' }}>
                            {{ $shift->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">{{ __('Judul')}}</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">{{ __('Deskripsi')}}</label>
                <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">{{ __('Alamat')}}</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">{{ __('Upload Bukti')}}</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Kirim Pengajuan')}}</button>
            <a href="{{ route('employee.leave-application.index') }}" class="btn btn-secondary">{{ __('Kembali')}}</a>
        </form>
    </div>
@endsection
