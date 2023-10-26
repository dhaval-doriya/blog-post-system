@extends('frontend.layout.master')

@section('section')
<section class="section">
	<div class="container">
		<article class="row mb-4">
			<div class="col-lg-10 mx-auto mb-4">
				<h1 class="h2 mb-3">{{ $blog->name }}</h1>
				<ul class="list-inline post-meta mb-3">
					<li class="list-inline-item"><i class="ti-user mr-2"></i><a href="author.html">John
                     Doe</a>
					</li>
					<li class="list-inline-item">Date : March 14, 2020</li>
					<li class="list-inline-item">Categories : 
                        @forelse($blog->category as $cat)
                                <a href={{ route('category.all', ['slug' => $cat->slug]) }} class="ml-1">{{ $cat->name }}  </a>
                        @endforeach               
					</li>
					{{-- <li class="list-inline-item">Tags : <a href="#!" class="ml-1">Photo </a> ,<a href="#!" class="ml-1">Image </a>
					</li> --}}
				</ul>
			</div>
			<div class="col-12 mb-3">
				<div class="post-slider">
                    <img src="{{ asset($blog->image) }}" alt="" height="500px" width="auto">
				</div>
			</div>
			<div class="col-lg-10 mx-auto">
				<div class="content">
                    {!! html_entity_decode($blog->description) !!}
				</div>
			</div>
		</article>
	</div>
</section>

@endsection