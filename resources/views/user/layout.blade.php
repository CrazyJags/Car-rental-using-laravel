@extends('main')
@section('title', 'User')
@section('another-link')
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('another-script')
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}" defer></script>
    <script src="{{ asset('js/popper.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.sticky.js') }}" defer></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.animateNumber.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.fancybox.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}" defer></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}" defer></script>
    <script src="{{ asset('js/aos.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection

@section('content')
    <div class="layout">
        <div class="header py-5">
            <div class="left">
                <div class="logo">
                    <span>Lo</span>
                    <i class="fas fa-car"></i>
                    <span>tion</span>
                </div>
            </div>
            <div class="middle">

            </div>
            <div class="right">
                <a class="link" href="/">
                    Home
                </a>
                <a href="/cars" class="link">
                    Cars
                </a>
                @if (auth()->check())
                    <a href="/rents" class="link">
                        My Rents
                    </a>
                    <form action="/logout" method="post">
                        @csrf
                        <button class="btn btn-rounded"><i class="fa fa-sign-out"></i></button>
                    </form>
                @else
                    <a href="/login" class="link">
                        Sign in
                    </a>

                    <a href="/register" class="link">
                        Register
                    </a>
                @endif

            </div>
        </div>
        <div class="page-content">
            <div class="page">
                @yield('user-page')
            </div>

            <!-- Footer -->
            <footer class="text-center text-lg-start  bg-light text-muted mt-3">
                <!-- Section: Social media -->
                <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                    <!-- Left -->
                    <div class="me-5 d-none d-lg-block">
                        <span>Get connected with us on social networks:</span>
                    </div>
                    <!-- Left -->

                    <!-- Right -->
                    <div>
                        <a href="" class="me-4 text-reset mx-2">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="" class="me-4 text-reset mx-2">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="" class="me-4 text-reset mx-2">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="" class="me-4 text-reset mx-2">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                    <!-- Right -->
                </section>
                <!-- Section: Social media -->

                <!-- Section: Links  -->
                <section class="">
                    <div class="container text-center text-md-start mt-5">
                        <!-- Grid row -->
                        <div class="row mt-3">
                            <!-- Grid column -->
                            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                                <!-- Content -->
                                <h6 class="text-uppercase fw-bold mb-4">
                                    Lo<i class="fas fa-car-alt me-3"></i>tion
                                </h6>
                                <p>
                                    We are a well known car rental company and our investors are very proud of the success of our company
                                </p>
                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                                <!-- Links -->
                                <h6 class="text-uppercase fw-bold mb-4">
                                    Best brands
                                </h6>
                                <p>
                                    <a href="#" class="text-reset">Toyota</a>
                                </p>
                                <p>
                                    <a href="#" class="text-reset">Tesla</a>
                                </p>
                                <p>
                                    <a href="#" class="text-reset">Ford</a>
                                </p>
                                <p>
                                    <a href="#" class="text-reset">Lada</a>
                                </p>
                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                                <!-- Links -->
                                <h6 class="text-uppercase fw-bold mb-4">
                                    Useful links
                                </h6>
                                <p>
                                    <a href="/" class="text-reset">Home</a>
                                </p>
                                <p>
                                    <a href="/cars" class="text-reset">Cars</a>
                                </p>
                                <p>
                                    <a href="/rents" class="text-reset">Rents</a>
                                </p>
                                <p>
                                    <a href="#" class="text-reset">Help</a>
                                </p>
                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                                <!-- Links -->
                                <h6 class="text-uppercase fw-bold mb-4">
                                    Contact
                                </h6>
                                <p><i class="fas fa-home me-3"></i> Lovely Professional University, Punjab</p>
                                <p>
                                    <i class="fas fa-envelope me-3"></i>
                                    jagadeesh.ch26@gmail.com
                                </p>
                                <p><i class="fas fa-phone me-3"></i> +91 7013258814</p>
                                <p><i class="fas fa-phone-alt me-3"></i> +91 xxxxxxxxxx</p>
                            </div>
                            <!-- Grid column -->
                        </div>
                        <!-- Grid row -->
                    </div>
                </section>
                <!-- Section: Links  -->

                <!-- Copyright -->
                <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                    © 2022 Copyright:
                    <a class="text-reset fw-bold" href="/locartion">Locartion - Jagadeesh Chilukuri</a>
                </div>
                <!-- Copyright -->
            </footer>
            <!-- Footer -->
        </div>

    </div>
@endsection
