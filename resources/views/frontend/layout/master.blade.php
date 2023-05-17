<!DOCTYPE html>
<html lang="en">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Site Metas -->
<title>@yield('title')
</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<!-- Site Icons -->
<link rel="shortcut icon" href="{{ asset('assets/frontside/images/favicon.ico') }} " type="image/x-icon" />
<link rel="apple-touch-icon" href="{{ asset('assets/frontside/images/apple-touch-icon.png') }}">
<script src="{{ asset('assets/dashboard/plugins/jquery/jquery.min.js') }}"></script>

<!-- Design fonts -->
<link href="{{ asset('https://fonts.googleapis.com/css?family=Droid+Sans:400,700') }}" rel="stylesheet">

<!-- Bootstrap core CSS -->
<link href="{{ asset('assets/frontside/css/bootstrap.css') }}" rel="stylesheet">

<!-- FontAwesome Icons core CSS -->
<link href="{{ asset('assets/frontside/css/font-awesome.min.css') }}" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="{{ asset('assets/frontside/style.css') }}" rel="stylesheet">

<!-- Responsive styles for this template -->
<link href="{{ asset('assets/frontside/css/responsive.css') }}" rel="stylesheet">

<!-- Colors for this template -->
<link href="{{ asset('assets/frontside/css/colors.css') }}" rel="stylesheet">

<!-- Version Garden CSS for this template -->
<link href="{{ asset('assets/frontside/css/version/garden.css') }}" rel="stylesheet">

<!-- sweetalert2  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>


<link href="{{ asset('assets/custom_css/socialmedia.css') }}" rel="stylesheet">


<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('css')

</head>

<body>
    <div id="wrapper">
        <!-- end top-search -->
        <div class="topbar-section">
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <a class="text-white" onclick="window.location.replace(document.referrer)"> <i
                                class="fa fa-2x fa-arrow-left" aria-hidden="true"> </i>
                        </a>
                    </div>
                    <div>
                        <h1 class="text-white text-end">
                            <a href="{{ route('blog.all') }}">
                                Blog System
                            </a>
                        </h1>
                    </div>
                    <div>
                        @if (Auth::user())

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
                                <button class="dropdown-item  user-logout" data-action="{{ route('user.logout') }}">
                                    Log out
                                </button>
                            </div>
                            <form class="dropdown-item" action="{{ route('user.logout') }}" method="post"
                                id="user_logout">
                                @csrf
                                <button hidden class="dropdown-item" type="submit" class="btn btn-"> Log out</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="nav-link text-right">
                                <button type="button" class="btn btn-dark">Login </button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="header-section ">
            <!-- 3main image secrion  -->
            @yield('topblogs')
            <section class="section wb">
                <div class="container-fluid">
                    <div class="row">
                        @empty($categories)
                        @else
                            <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 ">
                                <div class="widget ">
                                    <h6 class="widget-title">All Categories</h6>
                                    <div class="link-widget">
                                        <ul>
                                            @foreach ($categories as $cat)
                                                <li><a href="{{ route('category.all', ['slug' => $cat->slug]) }}">{{ $cat->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endempty


                        @yield('mainblogs')

                        <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                            <div class="sidebar widget ">
                                <div class="widget">
                                    <h2 class="widget-title">Search</h2>
                                    <form class="form-inline search-form" id="search-form" method="get">

                                        <div class="form-group">
                                            <input id="search" type="text" class="form-control"
                                                placeholder="Search Blog " name="search" required>
                                        </div>
                                        <!-- <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button> -->
                                    </form>
                                </div>


                                @if (count($recentBlogs) > 0)
                                    <div class="widget">
                                        <h2 class="widget-title">Recent Posts</h2>
                                        <div class="blog-list-widget">
                                            <div class="list-group">
                                                @foreach ($recentBlogs as $blog)
                                                    <a href=" {{ route('blog.one', ['slug' => $blog->slug]) }}"
                                                        class="list-group-item list-group-item-action flex-column align-items-start">
                                                        <div class="w-100 justify-content-between">
                                                            <img src="{{ asset('blog-cover-images/' . $blog->image) }}"
                                                                alt="" class="img-fluid float-left">
                                                            <h5 class="mb-1">{{ $blog->name }}</h5>
                                                            <small>{{ $blog->created_at->format('dS F Y') }}</small>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                @endif
                                @if ($popularCategories ?? [])
                                    <div class="widget">
                                        <h2 class="widget-title">Popular Categories</h2>
                                        <div class="link-widget">
                                            <ul>
                                                @foreach ($popularCategories as $category)
                                                    <li><a
                                                            href="{{ route('category.all', ['slug' => $category['slug']]) }}">{{ $category['name'] }}
                                                            <span>({{ $category['total'] }})</span></a></li>
                                                @endforeach


                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>

        <!-- Core JavaScript
    ================================================== -->
        <script src="{{ asset('assets/frontside/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/frontside/js/tether.min.js') }}"></script>
        <script src="{{ asset('assets/frontside/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/frontside/js/custom.js') }}"></script>
        <script src="{{ asset('assets/custom_js/frontend/logout.js') }}"></script>
        <script src="https://kit.fontawesome.com/704ff50790.js" crossorigin="anonymous"></script>
        {{-- jquery validator  --}}
        <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

        <script src="{{ asset('assets/custom_js/frontend/infiniteLoadBlog.js') }}"></script>
</body>

</html>
