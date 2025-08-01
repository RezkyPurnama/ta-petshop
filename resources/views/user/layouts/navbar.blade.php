@extends('user.layouts.main')
@section('content')

    <!-- Navbar Start -->
    <div class="container-fluid sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
            <a class="navbar-brand d-flex align-items-center gap-2 me-auto">
                <h2 class="text-white mb-0">Petcare</h2>
                <img src="img/logo.png" alt="Logo Petcare" style="height:40px;">
            </a>

                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="index.html" class="nav-item nav-link active">Home</a>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="product.html" class="nav-item nav-link">Products</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu bg-light mt-2">
                                <a href="feature.html" class="dropdown-item">Features</a>
                                <a href="how-to-use.html" class="dropdown-item">How To Use</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                <a href="blog.html" class="dropdown-item">Blog Articles</a>
                                <a href="404.html" class="dropdown-item">404 Page</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                        <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                        <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                       <a href="contact.html" class="nav-item nav-link"> <i class="fas fa-shopping-cart me-1"></i> </a>

                    </div>
                    <!-- <a href="" class="btn btn-dark py-2 px-4 d-none d-lg-inline-block">Contoh</a> -->
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

@endsection
