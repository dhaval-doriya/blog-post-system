<!DOCTYPE html>

<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title>Logbook - Homepage</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="description" content="This is meta description">
    <meta name="author" content="Themefisher">

    <!-- theme meta -->
    <meta name="theme-name" content="logbook" />

    <!-- plugins -->
    <link rel="preload" href="https://fonts.gstatic.com/s/opensans/v18/mem8YaGs126MiZpBA-UFWJ0bbck.woff2"
        style="font-display: optional;">
    <link rel="stylesheet" href={{ asset('client/plugins/bootstrap/bootstrap.min.css') }}>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Montserrat:600%7cOpen&#43;Sans&amp;display=swap" media="screen">

    <link rel="stylesheet" href={{ asset('client/plugins/themify-icons/themify-icons.css') }}>
    <link rel="stylesheet" href={{ asset('client/plugins/slick/slick.css') }}>

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href={{ asset('client/css/style.css') }}>

    <!--Favicon-->
    <link rel="shortcut icon" href={{ asset('client/images/favicon.png') }} type="image/x-icon">
    <link rel="icon" href={{ asset('client/images/favicon.png') }} type="image/x-icon">

    <!-- sweetalert2  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <!-- navigation -->
    <header class="sticky-top bg-white border-bottom border-default">
        <div class="container">

            <nav class="navbar navbar-expand-lg navbar-white">
                <a class="navbar-brand" href={{ route('blog.all') }}>
                    <img class="img-fluid" width="150px" src={{ asset('client/images/logo.png') }} alt="LogBook">
                </a>
                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navigation">
                    <i class="ti-menu"></i>
                </button>

                <div class="collapse navbar-collapse text-center" id="navigation">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                homepage
                                {{-- <i class="ti-angle-down ml-1"></i> --}}
                            </a>
                            {{-- <div class="dropdown-menu">
                     <a class="dropdown-item" href="index-full.html">Homepage Full Width</a>
                     <a class="dropdown-item" href="index-full-left.html">Homepage Full With Left Sidebar</a>
                     <a class="dropdown-item" href="index-full-right.html">Homepage Full With Right Sidebar</a>
                     <a class="dropdown-item" href="index-list.html">Homepage List Style</a>
                     <a class="dropdown-item" href="index-list-left.html">Homepage List With Left Sidebar</a>
                     <a class="dropdown-item" href="index-list-right.html">Homepage List With Right Sidebar</a>
                  </div> --}}
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">About</a>
                        </li>

                        <li>
                            {{-- @if (Auth::user())

                                <a class="nav-link  text-right" data-toggle="dropdown" href="#">
                                    <div class="user-panel pb-2 mb-2 d-flex ">
                                        <p>
                                            {{ Auth::user()->name }}
                                        </p>
                                        <div class="image ">
                                            @if (Auth::user()->profile_image)
                                                <img src="  {{ asset('profile-images/' . Auth::user()->profile_image) }}"
                                                    class="img-circle rounded-circle " alt="User Image" height="45px"
                                                    width="45px">
                                            @else
                                                <img src="{{ asset('assets/dashboard/dist/img/user2-160x160.jpg') }}"
                                                    class="img-circle elevation-2 rounded-circle " alt="User Image"
                                                    height="45px" width="45px">
                                            @endif
                                        </div>
                                    </div>
                                </a>
                                <div class=" dropdown-menu dropdown-menu-lg dropdown-menu-right ">
                                    <a href=" {{ route('dashboard') }}">
                                        <button class="dropdown-item" class="btn btn-success"> Dashboard</button>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <button class="dropdown-item  user-logout"
                                        data-action="{{ route('user.logout') }}">
                                        Log out
                                    </button>
                                </div>
                                <form class="dropdown-item" action="{{ route('user.logout') }}" method="post"
                                    id="user_logout">
                                    @csrf
                                    <button hidden class="dropdown-item" type="submit" class="btn btn-"> Log
                                        out</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="nav-link text-right">
                                    <button type="button" class="btn btn-dark">Login </button>
                                </a>
                            @endif --}}
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Pages <i class="ti-angle-down ml-1"></i>
                            </a>
                            {{-- <div class="dropdown-menu">
                     <a class="dropdown-item" href="author.html">Author</a>
                     <a class="dropdown-item" href="post-details-1.html">Post Details 1</a>
                     <a class="dropdown-item" href="post-details-2.html">Post Details 2</a>
                     <a class="dropdown-item" href="post-elements.html">Post Elements</a>
                     <a class="dropdown-item" href="privacy-policy.html">Privacy Policy</a>
                     <a class="dropdown-item" href="terms-conditions.html">Terms Conditions</a>
                  </div> --}}
                        </li>
                    </ul>
                    <!-- search -->
                    <div class="search px-4">
                        <button id="searchOpen" class="search-btn"><i class="ti-search"></i></button>
                        <div class="search-wrapper">
                            {{-- action="javascript:void(0)" --}}
                            <form class="form-inline search-form" id="search-form" class="h-100" method="get">
                                <input class="search-box pl-4" id="search-query" name="search" type="search"
                                    placeholder="Type &amp; Hit Enter...">
                            </form>
                            <button id="searchClose" class="search-close"><i class="ti-close text-dark"></i></button>
                        </div>
                    </div>

                </div>
            </nav>
        </div>
    </header>
    <!-- /navigation -->



    @yield('section')

    <footer class="section-sm pb-0 border-top border-default">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-3 mb-4">
                    <a class="mb-4 d-block" href="index.html">
                        <img class="img-fluid" width="150px" src={{ asset('client/images/logo.png') }}
                            alt="LogBook">
                    </a>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                </div>

                <div class="col-lg-2 col-md-3 col-6 mb-4">
                    <h6 class="mb-4">Quick Links</h6>
                    <ul class="list-unstyled footer-list">
                        <li><a href="about.html">About</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="privacy-policy.html">Privacy Policy</a></li>
                        <li><a href="terms-conditions.html">Terms Conditions</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 col-6 mb-4">
                    <h6 class="mb-4">Social Links</h6>
                    <ul class="list-unstyled footer-list">
                        <li><a href="#">facebook</a></li>
                        <li><a href="#">twitter</a></li>
                        <li><a href="#">linkedin</a></li>
                        <li><a href="#">github</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4">
                    <h6 class="mb-4">Subscribe Newsletter</h6>
                    <form class="subscription" action="javascript:void(0)" method="post">
                        <div class="position-relative">
                            <i class="ti-email email-icon"></i>
                            <input type="email" class="form-control" placeholder="Your Email Address">
                        </div>
                        <button class="btn btn-primary btn-block rounded" type="submit">Subscribe now</button>
                    </form>
                </div>
            </div>
            <div class="scroll-top">
                <a href="javascript:void(0);" id="scrollTop"><i class="ti-angle-up"></i></a>
            </div>
            <div class="text-center">
                {{-- <p class="content">&copy; 2020 - Design &amp; Develop By <a href="https://themefisher.com/" target="_blank">Themefisher</a></p> --}}
            </div>
        </div>
    </footer>


    <!-- JS Plugins -->
    <script src="{{ asset('client/plugins/jQuery/jquery.min.js') }}"></script>
    <script src="{{ asset('client/plugins/bootstrap/bootstrap.min.js') }}" async></script>
    <script src="{{ asset('client/plugins/slick/slick.min.js') }}"></script>
    {{-- //custom  --}}
    <script src="{{ asset('assets/frontside/js/custom.js') }}"></script>
    <script src="{{ asset('assets/custom_js/frontend/logout.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    <script src="{{ asset('assets/custom_js/frontend/infiniteLoadBlog.js') }}"></script>

    <!-- Main Script -->
    <script src="{{ asset('client/js/script.js') }}"></script>
</body>

</html>
