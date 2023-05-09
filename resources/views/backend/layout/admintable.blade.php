@if (count($blogs))

    @forelse($blogs as $blog)
        <tr >
            <td> {{ $blog->name }}</td>
            <td> {{ $blog->user->name }}</td>
            <td> {{ $blog->image }}</td>
            <td> {{ $blog->views }}</td>
            <td> {{ $blog->created_at }}</td>
            <td> {{ $blog->status ? 'approved' : 'unapproved' }}</td>
            <td>
                @if (!$blog->status)
                    <button class="btn btn-success  btn-sm approve-blog"
                        data-text="Are you sure you want to approve this blog?" data-id="{{ $blog->id }}"
                        data-action=" {{ route('approve.blog', ['id' => $blog->id]) }}">Approve</button>
                @else
                    <button class="btn btn-danger  btn-sm approve-blog"
                        data-text="Are you sure you want to unapprove this blog?" data-id="{{ $blog->id }}"
                        data-action=" {{ route('approve.blog', ['id' => $blog->id]) }}">
                        Un_Approve</button>
                @endif
            </td>
        </tr>

    @endforeach
    <td colspan="8" align="center">
        {!! $blogs->links() !!}
    </td>
@else
    <script src="{{ asset('assets/custom_js/redirectTable.js') }}"></script>
@endif
