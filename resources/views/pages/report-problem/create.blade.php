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

        <form action="{{ route('employee.report-problem.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

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
                <label for="address" class="form-label">{{ __('Alamat') }}</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">{{ __('Upload Bukti') }}</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Kirim Pengajuan') }}</button>
            <a href="{{ route('employee.report-problem.index') }}" class="btn btn-secondary">{{ __('Kembali') }}</a>
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
