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
        <div class="row justify-content-center">

            <!-- Kotak Kiri (Profil Singkat) -->
            <div class="col-md-4 mb-4">
                <div class="card rounded shadow-sm text-center">
                    <div class="card-body">
                        <div class="rounded-circle bg-primary bg-opacity-25 d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width: 100px; height: 100px; font-size: 40px; background-color: #0d6efd; color: white">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <h5 class="card-title fw-bold">{{ $user->name }}</h5>
                        <p class="text-muted mb-1">{{ $user->email }}</p>
                        <p class="text-muted">Nomor Telepon: {{ $user->phone_number }}</p>
                    </div>
                </div>
            </div>

            <!-- Kotak Kanan (Detail Profil) -->
            <div class="col-md-8">
                <div class="card rounded shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title fw-bold mb-4">Informasi Profil</h4>

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                        </div>

                        @if ($prefix !== 'admin')
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <input type="text" class="form-control" value="{{ $user->gender }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" value="{{ $user->phone_number }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <input type="text" class="form-control" value="{{ $user->gender }}" readonly>
                            </div>
                        @endif

                        <div class="text-end">
                            <a href="{{ route($prefix . '.profile.edit') }}" class="btn btn-primary rounded px-4">Edit
                                Profil</a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
