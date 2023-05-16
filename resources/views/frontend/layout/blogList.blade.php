@foreach($blogs as $blog)
<div class="blog-box row">
    <div class="col-md-4">
        <div class="post-media">
            <a href="{{route('blog.one', ['slug' => $blog->slug])}}" title="">
                <img class="mt-4" src="{{ asset('blog-cover-images//'.$blog->image) }}" alt=" " height="250px">
                <div class="hovereffect"></div>
            </a>
        </div>
    </div>
    <div class="blog-meta big-meta col-md-8">
        @forelse($blog->category as $cat)
        <span class="bg-aqua"><a href="{{route('category.all', ['slug' => $cat->slug])}}" title="">{{$cat->name}} </a></span>&nbsp; &nbsp;


        {{-- <span class="bg-aqua"><a href="?slug={{$cat->slug}}" title="">{{$cat->name}} </a></span>&nbsp; &nbsp; --}}

        @endforeach
        <h4><a href="{{route('blog.one', ['slug' => $blog->slug])}}" title=""> {{$blog->name}}</a></h4>
        <p>{{$blog->short_description}}</p>
        <small><a href="{{route('blog.one', ['slug' => $blog->slug])}}" title=""><i class="fa fa-eye"></i> {{$blog->views}}</a></small>
        <small><a href="{{route('blog.one', ['slug' => $blog->slug])}}" title="">{{ $blog->created_at->format('dS F Y')}}</small>
        <small><a href="{{route('blog.user' , ['id' => $blog->user->id ])}}" title="">by {{$blog->user->name}}</a></small>
    </div>
</div>
<hr class="invis">
@endforeach

