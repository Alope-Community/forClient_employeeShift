@extends('layouts.app')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        <h1 class="mb-4">{{ __('Tambah Data User') }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @php
            $prefix = auth('admin')->check() ? 'admin' : (auth('shift_leader')->check() ? 'shift-leader' : null);
        @endphp

        <form action="{{ route($prefix . '.user.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Nama') }}</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">{{ __('Role') }}</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="">-- Pilih Role --</option>
                    @auth('admin')
                        <option value="admin">Admin</option>
                        <option value="shift_leader">Shift Leader</option>
                        <option value="employee">Employee</option>
                    @endauth
                    @auth('shift_leader')
                        <option value="employee">Employee</option>
                    @endauth
                </select>
            </div>

            <div id="additionalFields">
                <div class="mb-3">
                    <label for="username" class="form-label">{{ __('Username') }}</label>
                    <input type="text" name="username" id="username" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">{{ __('Jenis Kelamin') }}</label>
                    <select name="gender" id="gender" class="form-select">
                        <option value="">-- Pilih Gender --</option>
                        <option value="Pria">Laki-laki</option>
                        <option value="Wanita">Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">{{ __('Alamat') }}</label>
                    <textarea name="address" id="address" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">{{ __('Nomor Telepon') }}</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Kata Sandi') }}</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">{{ __('Konfirmasi Kata Sandi') }}</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        const roleSelect = document.getElementById('role');
        const additionalFields = document.getElementById('additionalFields');

        function toggleAdditionalFields() {
            const selectedRole = roleSelect.value;
            if (selectedRole === 'admin') {
                additionalFields.style.display = 'none';
            } else {
                additionalFields.style.display = 'block';
            }
        }

        // Inisialisasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', toggleAdditionalFields);
        // Reaksi saat user memilih role
        roleSelect.addEventListener('change', toggleAdditionalFields);
    </script>
@endpush
