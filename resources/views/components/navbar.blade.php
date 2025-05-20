<nav class="navbar bg-white shadow-sm px-4 sticky-top" style="z-index: 1030;">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="{{asset('/assets/logo_white.png')}}" alt="Bukit Asam" height="40">
    </a>
    <a href="#" class="btn custom-login-btn px-4">
      Login
    </a>
  </div>
</nav>
  <div class="position-relative min-vh-100">
    <!-- Background Image -->
    <img src="{{ asset('/assets/hero.jpg') }}" 
        class="position-absolute top-0 start-0 w-100 h-100" 
        style="object-fit: cover; z-index: 0;" 
        alt="Hero Background">

    <!-- Overlay + Text -->
    <div class="overlay d-flex flex-column justify-content-center align-items-center text-white text-center">
      <h1 class="display-4 fw-bold">SISTEM MANAJEMEN</h1>
      <h1 class="display-4 fw-bold">SHIFT</h1>
      <img src="{{ asset('/assets/logo_white.png') }}" alt="Logo" class="logo-img mt-4">
    </div>
  </div>
