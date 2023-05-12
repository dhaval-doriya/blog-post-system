@if (count($blogs))


    @forelse($blogs as $blog)
        <tr>
            <td> {{ $blog->name }}</td>
            <td> {{ $blog->user->name }}</td>
            <td>
                @forelse($blog->category as $cat)
                    <p>
                        {{ $cat->name }} <br>
                    </p>
                @endforeach
            </td>
            <td> {{ $blog->views }} </td>
            <td>
                <img src="{{ asset('blog-cover-images/' . $blog->image) }}" id="uploaded_image" class="img-responsive "
                    height="100px" />
            </td>
            <td> {{ $blog->created_at }}</td>

            @if (Auth::user()->role == 'admin')
                <td>
                    @if (!$blog->status)
                        <button class="btn btn-  btn-sm approve-blog" title="Blog is not Approved"
                            data-text="Are you sure you want to approve this blog?" data-id="{{ $blog->id }}"
                            data-action=" {{ route('approve.blog', ['id' => $blog->id]) }}">
                            <i class="fa fa-thumbs-down text-danger " aria-hidden="true">
                            </i>
                            DisApproved</button>
                    @else
                        <button class="btn btn-  btn-sm approve-blog" title="Blog is Approved"
                            data-text="Are you sure you want to unapprove this blog?" data-id="{{ $blog->id }}"
                            data-action=" {{ route('approve.blog', ['id' => $blog->id]) }}">
                            <i class="fa fa-thumbs-up text-success " aria-hidden="true">
                            </i>
                            Approved</button>
                    @endif
                </td>
            @else
                <td> {{ $blog->status ? 'approved' : 'unapproved' }}</td>
            @endif
            <td>
                <div class=" d-flex justify-content-center">
                    <div>
                        <button title="Delete Blog" class="btn btn- remove-user" data-id="{{ $blog->slug }}"
                            data-action="{{ route('blog.destroy', ['blog' => $blog->id]) }}">
                            <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div>
                        <a href="{{ route('blog.one', ['slug' => $blog->slug]) }}">
                            <button title="View Blog" type="button" class="btn btn-">
                                <i class="fa fa-eye text-primary" aria-hidden="true"></i>

                            </button>
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('blog.edit', ['blog' => $blog->id]) }}">
                            <button title="Edit Blog" type="button" class="btn btn-">
                                <i class="fas fa-edit text-success"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </td>
        </tr>
    @empty
        <h2>No Record Found</h2>

    @endforelse

    <td colspan="8" align="center">
        {!! $blogs->links() !!}
    </td>
@else


    <script src="{{ asset('assets/custom_js/redirectTable.js') }}"></script>
@endif
