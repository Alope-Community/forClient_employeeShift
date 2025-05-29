@extends('layouts.app')

@section('content')
    @auth('employee')
    <section class="main p-3 ms-5 mt-3">
        <div class="container">
            <h1 class="h3 mb-2 fw-bold">Dashboard Employee</h1>
            <p class="mb-4">Selamat datang, {{ auth('employee')->user()->name }}</p>
            <div class="row">
                <div class="col-12 col-md-8 col-lg-4">
                    <div class="card shadow-lg border" style="border: 2px solid #054586 !important;">
                        <div class="card-body d-flex align-items-center">
                            <div class="bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
                                 style="width: 50px; height: 50px; background-color: #054586;">
                                <i class="lni lni-alarm fs-4 text-white"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-1">Shift Saat Ini</h5>
                                <p class="card-text text-muted mb-0">Shift Pagi (07:00 - 15:00)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endauth

    @auth('shift_leader')
    <section class="main p-3 mt-3">
        <div class="container">
            <h1>Dashboard Shift Leader</h1>
            <p>Selamat datang, {{ auth('shift_leader')->user()->name }}</p>
            <!-- Admin Card -->
            
            <h3>Notifikasi</h3>
            @forelse(auth()->user()->unreadNotifications as $notification)
            <div class="alert alert-info mb-2">
                <div>
                    <strong>{{ $notification->data['title'] }}</strong><br>
                    {{ $notification->data['message'] }}<br>
                    <small>{{ $notification->created_at->diffForHumans() }}</small>
                </div>
                <a href="{{ route('shift-leader.shift-change.edit', $notification->data['report_id']) }}"
                    class="btn btn-primary mt-2">Verifikasi Sekarang</a>
                </div>
                @empty
                <p>Tidak ada notifikasi.</p>
                @endforelse
            </div>
        </section>
        @endauth
        
        @auth('admin')
        <section class="main p-3 ms-5 mt-3">
            <div class="container">
                <h1>Dashboard Admin</h1>
                <p>Selamat datang, {{ auth('admin')->user()->name }}</p>
            </div>
        <div class="row g-4">
        <!-- Admin -->
        <div class="col-md-4">
            <div class="card card-border-left border-red">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                    <h5 class="card-title mb-0">Admin</h5>
                    <p class="fs-4 mb-0">95</p>
                    </div>
                    <i class="bi bi-person-fill icon"></i>
                </div>
            </div>
        </div>

        <!-- Shift Leader -->
        <div class="col-md-4">
            <div class="card card-border-left border-blue">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                    <h5 class="card-title mb-0">Shift Leader</h5>
                    <p class="fs-4 mb-0">95</p>
                    </div>
                    <i class="bi bi-person-fill icon"></i>
                </div>
            </div>
        </div>

        <!-- Karyawan -->
        <div class="col-md-4">
            <div class="card card-border-left border-navy">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                    <h5 class="card-title mb-0">Karyawan</h5>
                    <p class="fs-4 mb-0">95</p>
                    </div>
                    <i class="bi bi-person-fill icon"></i>
                </div>
            </div>
        </div>

        <!-- Shift -->
        <div class="col-md-6">
            <div class="card card-border-left border-green">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                    <h5 class="card-title mb-0">Shift</h5>
                    <p class="fs-4 mb-0">4</p>
                    </div>
                    <i class="bi bi-clock icon"></i>
                </div>
            </div>
        </div>

        <!-- Laporan -->
        <div class="col-md-6">
            <div class="card card-border-left border-yellow">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                    <h5 class="card-title mb-0">Laporan</h5>
                    <p class="fs-4 mb-0">4</p>
                    </div>
                    <i class="bi bi-journal-bookmark-fill icon"></i>
                </div>
            </div>
        </div>

        </div>
    </section>
    @endauth

    @guest
        <p class="text-center mt-4">Silakan login dulu</p>
    @endguest
@endsection
