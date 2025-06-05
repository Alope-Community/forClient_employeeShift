@extends('layouts.app')

@section('content')
    @auth('employee')
        <section class="main p-3 ms-5 mt-3">
            <div class="container">
                <h1 class="h3 mb-2 fw-bold">{{ __('Dashboard Karyawan') }}</h1>
                <p class="mb-4">{{ __('Selamat datang') }}, {{ auth('employee')->user()->name }}</p>
                @include('sections.dashboard.employee')
            </div>
        </section>
    @endauth

    @auth('shift_leader')
        <section class="main p-3 ms-5 mt-3">
            <div class="container">
                <h1>{{ __('Dashboard Shift Leader') }}</h1>
                <p>{{ __('Selamat datang') }}, {{ auth('shift_leader')->user()->name }}</p>
                <!-- Admin Card -->

                <h3>{{ __('Notifikasi') }}</h3>
                @forelse(auth()->user()->unreadNotifications as $notification)
                    <div class="alert alert-info mb-2">
                        <div>
                            <strong>{{ $notification->data['title'] }}</strong><br>
                            {{ $notification->data['message'] }}<br>
                            <small>{{ $notification->created_at->diffForHumans() }}</small>
                        </div>
                        <a href="{{ route('shift-leader.shift-change.edit', $notification->data['report_id']) }}"
                            class="btn btn-primary mt-2">{{ __('Verifikasi Sekarang') }}</a>
                    </div>
                @empty
                    <p>{{ __('Tidak ada notifikasi') }}.</p>
                @endforelse
            </div>
        </section>
    @endauth

    @auth('admin')
        <section class="main p-3 ms-5 mt-3">
            <div class="container">
                <h1>{{ __('Dashboard Admin') }}</h1>
                <p>{{ __('Selamat datang') }}, {{ auth('admin')->user()->name }}</p>
            </div>

            @include('sections.dashboard.admin')
        </section>
    @endauth

    @guest
        <p class="text-center mt-4">{{ __('Silakan login terlebih dahulu') }}</p>
    @endguest
@endsection
