@extends('backend.layout.master')

@section('title', 'categories')
@section('path', 'categories')
@section('Pagename', 'Category')


@section('maindata')

    <div id="dashboard">
        <div class="row card mb-5 ">
            <div class="col-12 d-flex justify-content-between rounded shadow-lg p-3 ">
                <div class="">
                    <h2></h2>
                </div>

                <div class=" d-flex justify-content-end  ">
                    <div>
                        <a href="{{ route('category.create') }}" class="nav-link">
                            <button type="button" class="ms-2 btn btn-success"><i class="fa fa-plus"
                                    aria-hidden="true"></i></button>
                        </a>
                    </div>
                    <br>
                    <div class="  ">
                        <input type="text" name="serach" id="serach" class="form-control rounded-pill" placeholder="Search" />
                        <small>Search by category Title, slug</small>
                    </div>
                </div>
            </div>

            <div class="col-12  mt-3">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <div id="item-lists">
                            @if (count($categories))
                                <div class="table">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="sorting" data-sorting_type="asc" data-column_name="name"
                                                    style="cursor: pointer">
                                                    Name
                                                    <span id="name_icon"><i class="fa fa-angle-up" aria-hidden="true"></i></span>
                                                </th>
                                                <th>Category Slug</th>
                                                <th>Number of Blogs </th>
                                                <th data-orderable="false">Action(s)</th>
                                                <th data-orderable="false">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabledata">
                                            @include('backend.category.table')
                                        </tbody>
                                    </table>
                                </div>
                                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                                <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                                <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                                <input type="hidden" name="hidden_table_name" id="hidden_table_name"
                                value="category" />
                            @else
                                <div class="container">
                                    <h1 class="text-center">You don't have Category <a
                                            href="{{ route('category.create') }}">
                                            Click here to Create
                                        </a></h1>
                                </div>
                                <script src="{{ asset('assets/custom_js/redirectTable.js') }}"></script>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('links')
@endsection
