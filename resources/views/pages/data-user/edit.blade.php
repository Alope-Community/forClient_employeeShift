@extends('layouts.app')

@section('title', 'Edit Data User')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        <h1>{{ __('Edit Data User') }}</h1>

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

        <form method="POST" action="{{ route($prefix . '.user.update', ['id' => $user->id, 'role' => $role]) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="editUserName" class="form-label">{{ __('Nama') }}</label>
                <input type="text" class="form-control" id="editUserName" name="name"
                    value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="editUserEmail" class="form-label">{{ __('Email') }}</label>
                <input type="email" class="form-control" id="editUserEmail" name="email"
                    value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="editUserRole" class="form-label">{{ __('Role') }}</label>
                <select class="form-select" id="editUserRole" name="role" required>
                    @auth('admin')
                        <option value="admin" {{ old('role', $role) == 'admin' ? 'selected' : '' }}>{{ __('Admin') }}
                        </option>
                        <option value="shift_leader" {{ old('role', $role) == 'shift_leader' ? 'selected' : '' }}>
                            {{ __('Shift Leader') }}
                        </option>
                        <option value="employee" {{ old('role', $role) == 'employee' ? 'selected' : '' }}>{{ __('Employee') }}
                        </option>
                    @endauth
                    @auth('shift_leader')
                        <option value="employee" {{ old('role', $role) == 'employee' ? 'selected' : '' }}>{{ __('Employee') }}
                        </option>
                    @endauth
                </select>
            </div>

            @if (in_array(old('role', $role), ['shift_leader', 'employee']))
                <div class="mb-3">
                    <label for="editUserUsername" class="form-label">{{ __('Username') }}</label>
                    <input type="text" class="form-control" id="editUserUsername" name="username"
                        value="{{ old('username', $user->username) }}" required>
                </div>

                <div class="mb-3">
                    <label for="editUserGender" class="form-label">{{ __('Gender') }}</label>
                    <select class="form-select" id="editUserGender" name="gender" required>
                        <option value="Pria" {{ old('gender', $user->gender) == 'Pria' ? 'selected' : '' }}>
                            {{ __('Pria') }}</option>
                        <option value="Wanita" {{ old('gender', $user->gender) == 'Wanita' ? 'selected' : '' }}>
                            {{ __('Wanita') }}
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="division" class="form-label">{{ __('Divisi') }}</label>
                    <select name="division" id="division" class="form-select">
                        <option value="">-- Pilih Divisi --</option>
                        <option value="Unit Personnel"
                            {{ old('division', $user->division) == 'Unit Personnel' ? 'selected' : '' }}>Unit Personnel
                        </option>
                        <option value="Ash FGD Personnel"
                            {{ old('division', $user->division) == 'Ash FGD Personnel' ? 'selected' : '' }}>Ash FGD
                            Personnel</option>
                        <option value="WTP Personnel"
                            {{ old('division', $user->division) == 'WTP Personnel' ? 'selected' : '' }}>Ash FGD Personnel
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="editUserAddress" class="form-label">{{ __('Alamat') }}</label>
                    <input type="text" class="form-control" id="editUserAddress" name="address"
                        value="{{ old('address', $user->address) }}" required>
                </div>

                <div class="mb-3">
                    <label for="editUserPhoneNumber" class="form-label">{{ __('Nomor Telepon') }}</label>
                    <input type="text" class="form-control" id="editUserPhoneNumber" name="phone_number"
                        value="{{ old('phone_number', $user->phone_number) }}" required>
                </div>
            @endif

            <div class="mb-3">
                <label for="editUserPassword" class="form-label">{{ __('Password') }}<small
                        class="text-muted">{{ __('kosongkan jika tidak
                                                                                                                                                diubah') }}</small></label>
                <input type="password" class="form-control" id="editUserPassword" name="password"
                    autocomplete="new-password">
            </div>

            <div class="mb-3">
                <label for="editUserPasswordConfirmation" class="form-label">{{ __('Konfirmasi Password') }}</label>
                <input type="password" class="form-control" id="editUserPasswordConfirmation" name="password_confirmation"
                    autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Simpan Perubahan') }}</button>
            <a href="{{ route($prefix . '.user.index') }}" class="btn btn-secondary ms-2">{{ __('Batal') }}</a>
        </form>
    </div>
@endsection
