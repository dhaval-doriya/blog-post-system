@foreach ($blogs as $blog)
    <article class="row mb-5">
        <div class="col-12">
            <div class="post-slider">
                <img loading="lazy" src="{{ asset($blog->image) }}" class="img-fluid"
                    alt="post-thumb">
            </div>
        </div>
        <div class="col-12 mx-auto">
            <h3><a class="post-title" href="{{ route('blog.one', ['slug' => $blog->slug]) }}">
                    {{ $blog->name }}</a></h3>
            <ul class="list-inline post-meta mb-4">
                <li class="list-inline-item"><i class="ti-user mr-2"></i>
                    <a href={{ route('blog.user', ['id' => $blog->user->id]) }}>by {{ $blog->user->name }}</a>
                </li>
                <li class="list-inline-item">{{ $blog->created_at }}</li>
                <li class="list-inline-item">Categories :
                    @forelse($blog->category as $cat)
                        <a href={{ route('category.all', ['slug' => $cat->slug]) }} title="">{{ $cat->name }}
                        </a>
                    @endforeach
                </li>               
                <li>
                    <small><a href="{{ route('blog.one', ['slug' => $blog->slug]) }}"
                            title="">{{ $blog->created_at }}</small>

                    <small><a href="{{ route('blog.one', ['slug' => $blog->slug]) }}" title=""><i
                                class="fa fa-eye"></i> {{ $blog->views }}</a></small>

                </li>
            </ul>
            <p></a>
        </div>
    </article>
@endforeach
