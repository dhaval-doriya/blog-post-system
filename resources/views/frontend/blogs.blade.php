@extends('frontend.layout.master')

@section('section')
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8  mb-5 mb-lg-0">
					@include('frontend.layout.blogList')
                </div>		
                @include('frontend.layout.aside')
            </div>
        </div>
    </section>
@endsection
