@extends('backend.layout.master')

@section('title', ' blogs')
@section('path', 'blogs')
@section('Pagename', 'Blogs')

@section('maindata')
    <div id="dashboard">
        <div class="row mb-3 card">
            <div class="col-12 ">

                <div class="col-12 d-flex justify-content-between rounded shadow-lg p-3 " id="table_header">
                    <h2></h2>
                    <div class="col-6 d-flex justify-content-end  ">

                        @if (Auth::user()->role == 'user')
                            <div>
                                <a href="{{ route('blog.create') }}" class="nav-link ">
                                    <button class="btn btn-primary"> <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </a>
                            </div>
                        @endif
                        <br>
                        <div class="   ">
                            <small>Search by blog Title, slug</small>
                            <input type="text" name="serach" id="serach" class="form-control rounded-pill"
                            placeholder="Search" />
                            <small class="text-danger" hidden id="searchMessage"> Enter Atleast 3 Charecters </small>
                            <br>
                        </div>
                    </div>
                </div>
                @if (count($blogs))
                    <div class="col-12 mt-3">
                        <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                            <div class="card-body ">
                                <div id="item-lists">
                                    <div class="table">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="sorting" data-sorting_type="asc" data-column_name="name"
                                                        style="cursor: pointer">
                                                        name
                                                        <span id="name_icon"> <i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                                    </th>
                                                    <th>Writer</th>
                                                    <th>categories </th>
                                                    <th>views </th>
                                                    <th>cover image</th>
                                                    <th>Published Date</th>
                                                    <th> Blog Status</th>
                                                    <th data-orderable="false">Actions </th>
                                                </tr>
                                            </thead>

                                            @include('backend.blog.table')
                                        </table>
                                    </div>
                                </div>
                                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                                <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                                <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />

                                <input type="hidden" name="hidden_table_name" id="hidden_table_name" value="blog" />
                                {{-- {!! $blogs->links() !!} --}}
                            @else
                                @if (Auth::user()->role == 'admin')
                                    <div class="col-12 mt-3 p-3">
                                        <div class="container mt-4">
                                            <h1 class="text-center">You don't have blogs to <a
                                                    href="{{ route('blog.all') }}">
                                                    Click here to view
                                                </a></h1>
                                        </div>
                                    </div>
                                @else
                                    <div class="container mt-4 p-3">
                                        <h1 class="text-center">You don't have pending blogs. Click here to <a
                                                href="{{ route('blog.create') }}">
                                                create a new blog
                                            </a></h1>
                                    </div>
                                @endif

                @endif

            </div>
        </div>
    </div>

@endsection
