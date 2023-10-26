<h4>Display Comments</h4>

@include('frontend.layout.commentsDisplay', ['comments' => $blog->comments, 'blog_id' => $blog->id])

<hr />
@guest
<h4>Login to add comment</h4>

@endguest
@auth 
<h4>Add comment</h4>

<form method="post" action="{{ route('comments.store'   ) }}">
    @csrf
    <div class="form-group">
        <textarea class="form-control" name="body"></textarea>
        <input type="hidden" name="blog_id" value="{{ $blog->id }}" />
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-success" value="Add Comment" />
    </div>
</form>
@endauth