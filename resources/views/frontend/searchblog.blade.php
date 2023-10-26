@extends('frontend.layout.master')

@section('section')
<section class="section">
	<div class="container">
        <div class="page-wrapper">
            <h1 class="text">
                {{ $message ?? '' }}
            </h1>
            <div class="blog-list clearfix">
                @if (!count($blogs))
                    <h1>NO result found</h1>
                @else
                    <div id="blog-list">

                        @include('frontend.layout.blogList')
                    </div>
                    <div class="auto-load text-center" style="display: none;">
                        <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="60"
                            viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                            <path fill="#000"
                                d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                <animateTransform attributeName="transform" attributeType="XML" type="rotate"
                                    dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                            </path>
                        </svg>
                    </div>
                    @endif
            </div>
        </div>
    </div>
</section>
@endsection