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

                @include('sections.dashboard.shift-leader')
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
