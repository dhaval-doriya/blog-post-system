@if (count($categories))

    @foreach ($categories as $cat)
        <tr>
            <td>{{ $cat->name }}</td>
            <td>{{ $cat->slug }}</td>
            <td>{{ count($cat->blog) }}</td>
            <td>
                <div class=" d-flex justify-content-center">
                    <div>
                        <button title="Delete Category" class="btn btn- remove-user"
                            data-action="{{ route('category.destroy', ['category' => $cat->id]) }}">
                            <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                        </button>
                    </div>

                    <div>
                        <a href="{{ route('category.edit', ['category' => $cat->id]) }}">
                            <button title="Edit Category" type="button" class="btn btn-">
                                <i class="fas fa-edit  text-success"></i>
                            </button>
                        </a>
                    </div>
                </div>

            </td>
            <td>
                @if ($cat->status)
                    <label class="switch">
                        <input type="checkbox" checked class="manage-status"
                            data-action="{{ route('manage.category', ['id' => $cat->id]) }}" />
                        <div></div>
                    </label>
                @else
                    <label class="switch">
                        <input type="checkbox" class="manage-status"
                            data-action="{{ route('manage.category', ['id' => $cat->id]) }}" />
                        <div></div>
                    </label>
                @endif
            </td>
        </tr>
    @endforeach
    <td colspan="5" align="center">
        {!! $categories->links() !!}

    </td>
@else


<td colspan="5" align="center">
    <h2 class="text-center">No Record Found</h2>
</td>


    <script src="{{ asset('assets/custom_js/redirectTable.js') }}"></script>


@endif
