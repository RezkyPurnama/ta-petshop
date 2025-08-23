<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Q Petcare Padang - Petshop Terlengkap</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('admin/assets/img/avatars/logo 2.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Poppins:wght@200;600;700&display=swap"
        rel="stylesheet">
    {{--  animasi AOS  --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user/assets/lib/animate/animate.min.css') }} ">
    <link href="{{ asset('user/assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user/assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('user/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <style>

    </style>


    @include('user.layouts.spinner')
    <!-- Navbar Start -->
    <div class="container-fluid sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light p-0 navbar-custom">
                <a class="navbar-brand d-flex align-items-center gap-2 me-auto">
                    <h2 class="text-start mb-black">Q Petcare</h2>
                </a>

                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="{{ url('/') }}"
                            class="nav-item nav-link" >Home</a>

                        <a href="{{ url('/about') }}"
                            class="nav-item nav-link {{ Request::is('about') ? 'active' : '' }}">About</a>

                        <a href="{{ url('/product') }}"
                            class="nav-item nav-link {{ Request::is('product') ? 'active' : '' }}">Products</a>

                        <div class="nav-item dropdown">
                            <a href="#"
                                class="nav-link dropdown-toggle {{ request()->is('dog') || request()->is('cat') || request()->is('aksesoris') ? 'active' : '' }}"
                                data-bs-toggle="dropdown">
                                Pages
                            </a>
                            <div class="dropdown-menu bg-light mt-2">
                                <a href="{{ url('/dog') }}"
                                    class="dropdown-item {{ request()->is('dog') ? 'active' : '' }}">Dog</a>
                                <a href="{{ url('/cat') }}"
                                    class="dropdown-item {{ request()->is('cat') ? 'active' : '' }}">Cat</a>
                                <a href="{{ url('/aksesoris') }}"
                                    class="dropdown-item {{ request()->is('aksesoris') ? 'active' : '' }}">Aksesoris</a>
                            </div>
                        </div>


                        <a href="{{ url('/grooming') }}"
                            class="nav-item nav-link {{ Request::is('grooming') ? 'active' : '' }}">Grooming</a>

                        <a href="{{ url('/pet-hotel') }}"
                            class="nav-item nav-link {{ Request::is('pet-hotel') ? 'active' : '' }}">Pet Hotel</a>

                        <a href="{{ url('/pet-klinik') }}"
                            class="nav-item nav-link {{ Request::is('pet-klinik') ? 'active' : '' }}">Pet Klinik</a>

                        @auth
                            {{-- Jika user biasa (role = 0) --}}
                            @if (Auth::user()->isAdmin == 0)
                                <a href="{{ url(path: '/cart') }}" class="nav-item nav-link position-relative {{ Request::is('cart') ? 'active' : '' }}">
                                    <i class="fas fa-shopping-cart me-1"></i>
                                    {{-- Badge jumlah item --}}
                                    @if (isset($cartCount) && $cartCount > 0)
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ $cartCount }}
                                        </span>
                                    @endif
                                </a>
                            @endif

                            {{-- Dropdown Profil --}}

                            <div class="nav-item dropdown d-flex align-items-center">
                                <a>
                                    @if (Auth::user()->foto_profile)
                                        <img src="{{ asset('storage/profil/' . Auth::user()->foto_profile) }}"
                                            alt="Profile Image" class="rounded-circle" width="30" height="30">
                                    @else
                                        <i class="fas fa-user-circle fa-lg "></i>
                                    @endif
                                    <span class="fw-bold text-dark">{{ Auth::user()->name }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end bg-light mt-2">
                                    <a class="dropdown-item {{ request()->is('profile') ? 'active' : '' }}"
                                        href="{{ url('/profile') }}">
                                        <i></i> Profil
                                    </a>
                                    <a class="dropdown-item {{ request()->is('riwayat-pesanan') ? 'active' : '' }}"
                                        href="{{ url('/riwayat-pesanan') }}">
                                        <i></i> Riwayat Pesanan
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @else
                            {{-- Jika belum login --}}
                            <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                            <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                        @endauth

                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->



    @yield('content')

<!-- Footer Start -->
<div class="container-fluid bg-white footer" data-aos="fade-up">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Brand & Deskripsi -->
            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                <a href="/" class="d-inline-block mb-3">
                    <h1 class="text-primary">Petcare</h1>
                </a>
                <p class="mb-0">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet, erat non
                    malesuada consequat, nibh erat tempus risus, vitae porttitor purus nisl vitae purus.
                </p>
            </div>

            <!-- Kontak -->
            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                <h5 class="mb-4">Get In Touch</h5>
                <p><i class="fa fa-map-marker-alt me-3"></i>Jalan Raya Tanjung Sabang No.9, Tanjung Saba Pitameh
                    Nan XX, Kota Padang, Sumatera Barat, Indonesia 25155</p>
                <p><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                <p><i class="fa fa-envelope me-3"></i>info@example.com</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-square btn-outline-primary me-2"
                       href="https://api.whatsapp.com/send?phone=628116666604&text=Halo%20mimin,%20saya%20mau%20beli">
                       <i class="fab fa-whatsapp"></i>
                    </a>
                    <a class="btn btn-square btn-outline-primary me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-outline-primary me-2"
                       href="https://www.instagram.com/qpetcare_padang"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-square btn-outline-primary" href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- Link Populer -->
            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                <h5 class="mb-4">Popular Links</h5>
                <a class="btn btn-link" href="/about">About Us</a>
                <a class="btn btn-link" href="/product">Products</a>
                <a class="btn btn-link" href="/grooming">Grooming</a>
                <a class="btn btn-link" href="/pet-hotel">Pet Hotel</a>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="container py-3 border-top">
        <div class="row">
            <div class="col-12 text-center">
                <p class="mb-0 text-muted">
                    &copy; 2025 <strong>Petcare</strong>. All rights reserved. Powered by
                    <a href="#" class="text-primary fw-semibold text-decoration-none">QPetcarePadang</a>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

    <!-- Footer End -->


    <!-- Back to Top -->



    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user/assets/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('user/assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user/assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('user/assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('user/assets/js/main.js') }}"></script>
    {{--  Animasi AOS  --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')

    <script>
        AOS.init();
    </script>
</body>

</html>
