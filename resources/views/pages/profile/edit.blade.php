@extends('layouts.app')

@section('content')
    @php
        $prefix = Auth::guard('admin')->check()
            ? 'admin'
            : (Auth::guard('shift_leader')->check()
                ? 'shift-leader'
                : 'employee');
    @endphp

    <div class="main p-3 ms-5 mt-3">
        <div class="row">
            <div class="col-md-8">
                <div class="card rounded shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-4">{{ __('Edit Profile')}}</h4>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route($prefix . '.profile.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">{{ __('Nama')}}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">{{ __('Email')}}</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>

                            @if ($prefix !== 'admin')
                                <div class="mb-3">
                                    <label for="username" class="form-label fw-bold">{{ __('Username')}}</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        value="{{ old('username', $user->username) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="gender" class="form-label fw-bold">{{ __('Jenis Kelamin')}}</label>
                                    <select name="gender" id="gender" class="form-select" required>
                                        <option value="Pria"
                                            {{ old('gender', $user->gender) == 'Pria' ? 'selected' : '' }}>
                                            {{ __('Pria')}}</option>
                                        <option value="Wanita"
                                            {{ old('gender', $user->gender) == 'Wanita' ? 'selected' : '' }}>
                                            {{ __('Wanita')}}</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="phone_number" class="form-label fw-bold">{{ __('Nomor Telepon')}}</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        value="{{ old('phone_number', $user->phone_number) }}" required>
                                </div>
                            @endif

                            <hr class="my-4">

                            <p class="">{{ __('Ubah Password (Opsional)')}}</p>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">{{ __('Password Baru')}}</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Minimal 8 karakter">
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label fw-bold">{{ __('Konfirmasi Password')}}</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Ulangi password baru">
                            </div>

                            <div class="text-end">
                                <a href="{{ route($prefix . '.profile.index') }}"
                                    class="btn btn-secondary rounded-pill px-4 me-2">{{ __('Batal')}}</a>
                                <button type="submit" class="btn btn-primary rounded-pill px-4">{{ __('Simpan')}}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
