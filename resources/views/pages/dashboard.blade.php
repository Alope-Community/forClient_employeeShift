@extends('layouts.app')

@section('content')
    @auth('employee')
        <section class="main p-3 ms-3 mt-3">
            {{-- include we didieu khusus employee --}}
            <h1>Dashboard Employee</h1>
            <p>Selamat datang, {{ auth('employee')->user()->name }}</p>
            <form action="{{ route('employee.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </section>
    @endauth

    @auth('shift_leader')
        <section class="main p-3 ms-3 mt-3">
            <h1>Dashboard Shift Leader</h1>
            <p>Selamat datang, {{ auth('shift_leader')->user()->name }}</p>
            
            <h3>Notifikasi</h3>
            @forelse(auth()->user()->notifications as $notification)
                <div class="alert alert-info mb-2">
                    <strong>{{ $notification->data['title'] }}</strong><br>
                    {{ $notification->data['message'] }}<br>
                    <small>{{ $notification->created_at->diffForHumans() }}</small>
                </div>
            @empty
                <p>Tidak ada notifikasi.</p>
            @endforelse


            {{-- <form action="{{ route('shift-leader.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form> --}}
        </section>
    @endauth


    @guest
        <p>Silakan login dulu</p>
    @endguest
@endsection
