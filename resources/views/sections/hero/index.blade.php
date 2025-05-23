@extends('layouts.app')

@section('content')
    <div class="position-relative min-vh-100">
    <img src="{{ asset('/assets/hero.jpg') }}" 
        class="position-absolute top-0 start-0 w-100 h-100" 
        style="object-fit: cover; z-index: 0;" 
        alt="Hero Background">
    <div class="overlay d-flex flex-column justify-content-center align-items-center text-white text-center">
      <h1 class="display-4 fw-bold">SISTEM MANAJEMEN</h1>
      <h1 class="display-4 fw-bold">SHIFT</h1>
      <img src="{{ asset('/assets/logo_white.png') }}" alt="Logo" class="logo-img mt-4">
    </div>
  </div>
@endsection