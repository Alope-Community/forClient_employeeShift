@extends('layouts.app')

@section('content')
    @auth('employee')
        {{-- include we didieu khusus employee --}}
        <h1>Dashboard Employee</h1>
        <p>Selamat datang, {{ auth('employee')->user()->name }}</p>
        <form action="{{ route('employee.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    @endauth

    @auth('shift_leader')
        {{-- include we didieu khusus shift leader --}}
        <h1>Dashboard Shift Leader</h1>
        <p>Selamat datang, {{ auth('shift_leader')->user()->name }}</p>
        <form action="{{ route('shift-leader.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    @endauth
    

    @guest
        <p>Silakan login dulu</p>
    @endguest
@endsection
