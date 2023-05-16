@extends('frontend/layout/master')

@section('title', " $blog->name ")

@section('mainblogs')


    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 pl-5 pr-5">
        <div class="page-wrapper">

            <div class="blog-title-area">
                <h3>{{ $blog->name }}</h3>
                <div class="row">
                    @forelse($blog->category as $cat)
                        <span class="" style="background-color: rgba(116,160,68,255);"><a
                                href="{{ route('category.all', ['slug' => $cat->slug]) }}"
                                title="">{{ $cat->name }}</a></span> &nbsp; &nbsp; &nbsp;
                    @endforeach
                </div>
                <div class="blog-meta big-meta">
                    <small><a href="{{ route('blog.all') }}"
                            title="">{{ $blog->created_at->format('dS F Y') }}</a></small>
                    <small><a href="{{ route('blog.user', ['id' => $blog->user->id]) }}" title="">by
                            {{ $blog->user->name }}</a></small>
                    <small><a href="{{ route('blog.all') }}" title=""><i class="fa fa-eye"></i>
                            {{ $blog->views }}</a></small>
                </div>
            </div>

            <div class="single-post-media">

                <img src="{{ asset('blog-cover-images/' . $blog->image) }}" alt="" height="500px" width="auto">
            </div>

            <div class="blog-content">
                {!! html_entity_decode($blog->description) !!}

            </div>

            <hr class="invis1">

            <div class="custombox authorbox clearfix">
                <h4 class="small-title">About author</h4>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        @if ($blog->user->profile_image)
                            <img src="{{ asset('profile-images/' . $blog->user->profile_image) }}"
                                class="img-fluid rounded-circle" />
                        @else

                        {{-- <img src="{{ asset('profile-images/' . $blog->user->profile_image) }}"
                        class="img-fluid rounded-circle" /> --}}
                        @endif
                    </div><!-- end col -->

                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        <h4><a href="{{ route('blog.user', ['id' => $blog->user->id]) }}">{{ $blog->user->name }}</a>
                        </h4>
                        <p>Quisque sed tristique felis. Lorem <a href="#">visit my website</a> amet, consectetur
                            adipiscing elit. Phasellus quis mi auctor, tincidunt nisl eget, finibus odio. Duis tempus elit
                            quis risus congue feugiat. Thanks for stop Forest Time!</p>
                        <h4>Share this Blog on</h4>
                        @include('frontend.layout.social')
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end author-box -->
            <hr class="invis1">
        </div>
    </div>


    <script>
        // Get all share buttons
        const shareButtons = document.querySelectorAll('.share-button');
        // Add click event listener to each button
        shareButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Get the URL of the current page
                const url = window.location.href;
                // Get the social media platform from the button's class name
                const platform = button.classList[1];
                // Set the URL to share based on the social media platform
                let shareUrl;
                switch (platform) {
                    case 'facebook':
                        shareUrl =
                            `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
                        break;
                    case 'twitter':
                        shareUrl = `https://twitter.com/share?url=${encodeURIComponent(url)}`;
                        break;
                    case 'linkedin':
                        shareUrl = `https://www.linkedin.com/shareArticle?url=${encodeURIComponent(url)}`;
                        break;
                    case 'pinterest':
                        shareUrl =
                            `https://pinterest.com/pin/create/button/?url=${encodeURIComponent(url)}`;
                        break;
                    case 'reddit':
                        shareUrl = `https://reddit.com/submit?url=${encodeURIComponent(url)}`;
                        break;
                    case 'whatsapp':
                        shareUrl = `https://api.whatsapp.com/send?text=${encodeURIComponent(url)}`;
                        break;
                }
                // Open a new window to share the URL
                window.open(shareUrl, '_blank');
            });
        });
    </script>
@endsection
