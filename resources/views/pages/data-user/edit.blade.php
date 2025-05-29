@extends('layouts.app')

@section('title', 'Edit Data User')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        <h1>Edit Data User</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('user.update', ['id' => $user->id, 'role' => $role]) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="editUserName" class="form-label">Nama</label>
                <input type="text" class="form-control" id="editUserName" name="name"
                    value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="editUserEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="editUserEmail" name="email"
                    value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="editUserRole" class="form-label">Role</label>
                <select class="form-select" id="editUserRole" name="role" required>
                    <option value="admin" {{ old('role', $role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="shift_leader" {{ old('role', $role) == 'shift_leader' ? 'selected' : '' }}>Shift Leader
                    </option>
                    <option value="employee" {{ old('role', $role) == 'employee' ? 'selected' : '' }}>Employee</option>
                </select>
            </div>

            @if (in_array(old('role', $role), ['shift_leader', 'employee']))
                <div class="mb-3">
                    <label for="editUserUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" id="editUserUsername" name="username"
                        value="{{ old('username', $user->username) }}" required>
                </div>

                <div class="mb-3">
                    <label for="editUserGender" class="form-label">Gender</label>
                    <select class="form-select" id="editUserGender" name="gender" required>
                        <option value="Pria" {{ old('gender', $user->gender) == 'Pria' ? 'selected' : '' }}>Pria</option>
                        <option value="Wanita" {{ old('gender', $user->gender) == 'Wanita' ? 'selected' : '' }}>Wanita
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="editUserAddress" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="editUserAddress" name="address"
                        value="{{ old('address', $user->address) }}" required>
                </div>

                <div class="mb-3">
                    <label for="editUserPhoneNumber" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="editUserPhoneNumber" name="phone_number"
                        value="{{ old('phone_number', $user->phone_number) }}" required>
                </div>
            @endif

            <div class="mb-3">
                <label for="editUserPassword" class="form-label">Password <small class="text-muted">(kosongkan jika tidak
                        diubah)</small></label>
                <input type="password" class="form-control" id="editUserPassword" name="password"
                    autocomplete="new-password">
            </div>

            <div class="mb-3">
                <label for="editUserPasswordConfirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="editUserPasswordConfirmation" name="password_confirmation"
                    autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('data.user.index') }}" class="btn btn-secondary ms-2">Batal</a>
        </form>
    </div>
@endsection
