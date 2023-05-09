@if (count($users))

    @forelse($users as $user)
        <tr>
            <td>
                @if ($user->profile_image)
                    <img src="{{ asset('profile-images/' . $user->profile_image) }}" id="uploaded_image"
                        class="img-responsive img-circle" height="50px" />
                @else
                    <img src={{ asset('assets/dashboard/dist/img/user2-160x160.jpg') }} id="uploaded_image"
                        class="img-responsive img-circle" height="50px" />

            </td>
            </td>
    @endif
    <td> {{ $user->name }}</td>
    <td> {{ $user->email }}</td>
    <td> {{ $user->phone }}</td>

    <td>{{ count($user->blogs) }}</td>
    @php
        $totalviews = 0;
    @endphp
    @foreach ($user->blogs as $blog)
        <!-- {{ $totalviews += $blog->views }} -->
    @endforeach
    <td>{{ $totalviews }}</td>
    <!-- <td> {{ $user->status ? 'Active' : 'Inactive' }}</td> -->
    <td>
        <div class=" d-flex justify-content-center">
            <div>
                <button title="Delete User" class="btn btn- remove-user"
                    data-action="{{ route('user.delete', ['id' => $user->id]) }}">
                    <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                </button>
            </div>
            <div>
                <a href="{{ route('blog.user', ['id' => $user->id]) }}">
                    <button title="View User's Blogs" type="button" class="btn btn-">
                        <i class="fa fa-eye text-primary" aria-hidden="true"></i>

                    </button>
                </a>
            </div>
            <div>
                <a href="{{ route('user.update', ['id' => $user->id]) }}">
                    <button title="Update User" type="button" class="btn btn-">
                        <i class="fas fa-edit text-success"></i>
                    </button>
                </a>
            </div>
        </div>
    </td>
    <td>
        @if ($user->status)
            <label class="switch">
                <input type="checkbox" class="manage-status" checked
                    data-action="{{ route('manage.user', ['id' => $user->id]) }}" />
                <div></div>
            </label>
        @else
            <label class="switch">
                <input type="checkbox" class="manage-status"
                    data-action="{{ route('manage.user', ['id' => $user->id]) }}" />
                <div></div>
            </label>
        @endif
    </td>
    </tr>
@empty
    <p>No Users</p>
@endforelse
<td colspan="8" align="center">
    {!! $users->links() !!}
</td>
@else

<td colspan="8" align="center">
    <h2 class="text-center">No Record Found</h2>
</td>


<script src="{{ asset('assets/custom_js/redirectTable.js') }}"></script>


@endif
