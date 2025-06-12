@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
    <div class="main p-3 ms-5 mt-3">
        <h1 class="mb-4">{{ __('Detail User') }}</h1>

        @php
            $prefix = auth('admin')->check() ? 'admin' : (auth('shift_leader')->check() ? 'shift-leader' : null);
        @endphp

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $user->name }}</h5>
                <h6 class="card-subtitle mb-3 text-muted">
                    {{ __('Terdaftar sejak:') }} {{ $user->created_at->format('d F Y, H:i') }}
                </h6>

                <dl class="row">
                    <dt class="col-sm-3">{{ __('Nama') }}</dt>
                    <dd class="col-sm-9">{{ $user->name }}</dd>

                    <dt class="col-sm-3">{{ __('Email') }}</dt>
                    <dd class="col-sm-9">{{ $user->email }}</dd>

                    <dt class="col-sm-3">{{ __('Role') }}</dt>
                    <dd class="col-sm-9">
                        <span class="badge bg-primary text-capitalize">{{ str_replace('_', ' ', $role) }}</span>
                    </dd>

                    @if (in_array($role, ['shift_leader', 'employee']))
                        <dt class="col-sm-3">{{ __('Username') }}</dt>
                        <dd class="col-sm-9">{{ $user->username }}</dd>

                        <dt class="col-sm-3">{{ __('Jenis Kelamin') }}</dt>
                        <dd class="col-sm-9">{{ $user->gender }}</dd>

                        <dt class="col-sm-3">{{ __('Alamat') }}</dt>
                        <dd class="col-sm-9">{{ $user->address }}</dd>

                        <dt class="col-sm-3">{{ __('No. Telepon') }}</dt>
                        <dd class="col-sm-9">{{ $user->phone_number }}</dd>
                    @endif
                </dl>

                <a href="{{ route($prefix . '.user.index') }}" class="btn btn-secondary mt-3">{{ __('Kembali') }}</a>
            </div>
        </div>
    </div>
@endsection
