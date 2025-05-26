@extends('layouts.app')

@section('content')
    @auth('employee')
        <section class="main p-3 ms-3 mt-3">
            <h1>Dashboard Employee</h1>
            <p>Selamat datang, {{ auth('employee')->user()->name }}</p>
        </section>
    @endauth

    @auth('shift_leader')
        <section class="main p-3 ms-3 mt-3">
            <h1>Dashboard Shift Leader</h1>
            <p>Selamat datang, {{ auth('shift_leader')->user()->name }}</p>

            <h3>Notifikasi</h3>
            @forelse(auth()->user()->unreadNotifications as $notification)
                <div class="alert alert-info mb-2">
                    <div class="">
                        <strong>{{ $notification->data['title'] }}</strong><br>
                        {{ $notification->data['message'] }}<br>
                        <small>{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                    {{-- verifikasi sekarang button mengarah ke --}}
                    <a href="{{ route('shift-leader.shift-change.edit', $notification->data['report_id']) }}"
                        class="btn btn-primary mt-2">Verifikasi Sekarang</a>
                </div>
            @empty
                <p>Tidak ada notifikasi.</p>
            @endforelse

        </section>
    @endauth

    @auth('admin')
        <section class="main p-3 ms-3 mt-3">
            <h1>Dashboard Admin</h1>
            <p>Selamat datang, {{ auth('admin')->user()->name }}</p>
        </section>
    @endauth

    @guest
        <p>Silakan login dulu</p>
    @endguest
@endsection
