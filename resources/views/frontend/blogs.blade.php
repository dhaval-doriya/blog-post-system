@extends('frontend/layout/master')


@section('title', 'Homepage')
@section('topblogs')
    <section class="section first-section">
        @if (count($recentblogs) == 3)
            <div class="container-fluid">
                <div class="masonry-blog clearfix">
                    <div class="left-side">
                        <div class="masonry-box post-media">
                            <img src="{{ asset('blog-cover-images/' . $recentblogs[1]->image) }}" alt=""
                                height="450px">
                            <div class="shadoweffect">
                                <div class="shadow-desc">
                                    <div class="blog-meta">
                                        @forelse($recentblogs[1]->category as $cat)
                                            <span class="bg-aqua"><a
                                                    href="{{ route('category.all', ['slug' => $cat->slug]) }}"
                                                    title="">{{ $cat->name }}</a></span>
                                        @endforeach
                                        <h4><a href="{{ route('blog.one', ['slug' => $blogs[count($blogs) - 1]->slug]) }}"
                                                title="">{{ $recentblogs[1]->name }}</a></h4>
                                        <small><a
                                                href="{{ route('blog.one', ['slug' => $blogs[count($blogs) - 1]->slug]) }}"
                                                title="">{{ $recentblogs[1]->created_at->format('dS F Y') }}</a></small>
                                        <small><a href="#" title="">By
                                                {{ $recentblogs[1]->user->name }}</a></small>
                                    </div><!-- end meta -->
                                </div><!-- end shadow-desc -->
                            </div>
                        </div>
                    </div>
                    <div class="center-side ">
                        <div class="masonry-box post-media">
                            <img src="{{ asset('blog-cover-images/' . $recentblogs[2]->image) }}" alt=""
                                height="450px">
                            <div class="shadoweffect">
                                <div class="shadow-desc">
                                    <div class="blog-meta">
                                        @forelse($recentblogs[2]->category as $cat)
                                            <span class="bg-aqua"><a
                                                    href="{{ route('category.all', ['slug' => $cat->slug]) }}"
                                                    title="">{{ $cat->name }}</a></span>

                                        @endforeach
                                        <h4><a href="{{ route('blog.one', ['slug' => $recentblogs[2]->slug]) }}"
                                                title="">{{ $recentblogs[2]->name }}</a></h4>
                                        <small><a href="{{ route('blog.one', ['slug' => $recentblogs[2]->slug]) }}"
                                                title="">{{ $recentblogs[2]->created_at->format('dS F Y') }}</a></small>
                                        <small><a href="#" title=""> By
                                                {{ $recentblogs[2]->user->name }}</a></small>
                                    </div><!-- end meta -->
                                </div><!-- end shadow-desc -->
                            </div>
                        </div>
                    </div>

                    <div class="right-side hidden-md-down">
                        <div class="masonry-box post-media ">
                            <img src="{{ asset('blog-cover-images/' . $recentblogs[0]->image) }}" alt=""
                                height="450px">
                            <div class="shadoweffect">
                                <div class="shadow-desc">
                                    <div class="blog-meta">
                                        @forelse($recentblogs[0]->category as $cat)
                                            <span class="bg-aqua"><a
                                                    href="{{ route('category.all', ['slug' => $cat->slug]) }}"
                                                    title="">{{ $cat->name }}</a></span>
                                        @endforeach
                                        <h4><a href="{{ route('blog.one', ['slug' => $recentblogs[0]->slug]) }}"
                                                title="">{{ $recentblogs[0]->name }}</a></h4>
                                        <small><a href="{{ route('blog.one', ['slug' => $recentblogs[0]->slug]) }}"
                                                title="">{{ $recentblogs[0]->created_at->format('dS F Y') }}</a></small>
                                        <small><a href="#" title="">By
                                                {{ $recentblogs[0]->user->name }}</a></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endif
    </section>
@endsection
@section('mainblogs')
    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
        @if (count($blogs) > 0)
            <div class="widget ">
                <div class="page-wrapper ">
                    <div class="blog-list clearfix" id="blog-list">
                        @include('frontend.layout.blogList')
                    </div>
                </div>

                <hr class="invis">
                <div class="auto-load text-center" style="display: none;">
                    <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="60"
                        viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                        <path fill="#000"
                            d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                            <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                                from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                        </path>
                    </svg>
                </div>
                {{-- <div class="row">
                    <div class="col-md-12">
                        {{ $blogs->links() }}
                    </div>
                </div> --}}
            </div>
        @else
            @if (Auth::check())
                @if (Auth::user()->role == 'admin')
                    <div class="container">
                        <h1 class="text-center">Currently Don't Have Enough Blogs To Display. </h1>
                        <h3 class="text-center">You are admin so you can't Create Blog</h3>
                    </div>
                @else
                    <div class="container">
                        <h1 class="text-center">Currently Don't Have Enough Blogs To Display. </h1>
                        <h3 class="text-center"><a href="{{ route('blog.create') }}">
                                Click here to create a new blog
                            </a></h3>
                    </div>
                @endif
            @else
                <div class="container">
                    <h1 class="text-center">Currently Don't Have Enough Blogs To Display.</h1>
                    <h3 class="text-center">
                        <a href="{{ route('login') }}">
                            Click here to Login
                        </a>
                    </h3>
                </div>
            @endif

            <h6 class="text-center">Add atleast 3 blogs </h6>
        @endif
    </div>
@endsection
