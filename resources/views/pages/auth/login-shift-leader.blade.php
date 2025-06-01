@extends('layouts.auth')

@section('content')
    <div class="">
        <h1 class="mb-5 fs-2">{{ __('Login Shift Leader') }}</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('shift-leader.login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="d-flex justify-content-center align-items-center mt-3">
                <button class="btn login-btn px-4 w-50" type="submit">
                    Login
                </button>
            </div>
        </form>
    </div>
@endsection
