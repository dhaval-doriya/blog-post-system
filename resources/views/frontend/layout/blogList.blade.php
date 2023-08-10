@foreach ($blogs as $blog)
    <article class="row mb-5">
        <div class="col-12">
            <div class="post-slider">
                <img loading="lazy"  src={{ asset('client/images/post/post-6.jpg') }} class="img-fluid" alt="post-thumb">
                {{-- <img loading="lazy"  src="{{ asset('blog-cover-images//' . $blog->image) }}" class="img-fluid" alt="post-thumb"> --}}

                {{-- <img loading="lazy" src="images/post/post-1.jpg" class="img-fluid" alt="post-thumb">
            <img loading="lazy" src="images/post/post-3.jpg" class="img-fluid" alt="post-thumb"> --}}
            </div>
        </div>
        <div class="col-12 mx-auto">
            <h3><a class="post-title" href="{{ route('blog.one', ['slug' => $blog->slug]) }}">
                    {{ $blog->name }}</a></h3>
            <ul class="list-inline post-meta mb-4">
                <li class="list-inline-item"><i class="ti-user mr-2"></i>
                    <a href={{ route('blog.user', ['id' => $blog->user->id]) }}>by {{ $blog->user->name }}</a>
                </li>
                <li class="list-inline-item">{{ $blog->created_at->format('dS F Y') }}</li>

                <li class="list-inline-item">Categories :
                    @forelse($blog->category as $cat)
                        <a href={{ route('category.all', ['slug' => $cat->slug]) }} title="">{{ $cat->name }}
                        </a>
                    @endforeach

                </li>
                {{-- <li class="list-inline-item">Tags : <a href="#!" class="ml-1">Photo </a> ,<a href="#!" class="ml-1">Image </a></li> --}}
                <li>
                    <small><a href="{{ route('blog.one', ['slug' => $blog->slug]) }}"
                            title="">{{ $blog->created_at->format('dS F Y') }}</small>

                    <small><a href="{{ route('blog.one', ['slug' => $blog->slug]) }}" title=""><i
                                class="fa fa-eye"></i> {{ $blog->views }}</a></small>

                </li>
            </ul>
            <p></a>
        </div>
    </article>
@endforeach
