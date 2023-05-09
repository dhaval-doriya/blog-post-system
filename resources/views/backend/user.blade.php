@extends('backend.layout.master')

@section('title', 'User Dashboard')

@section('path', 'User Dashboard')
@section('Pagename', 'User Dashboard')

@section('maindata')

    <div class="content ">
        <div class="row">
            <div class="col-lg-3 col-6  ">
                <!-- small box -->
                <div class="small-box bg-info shadow-lg rounded p-3">
                    <div class="inner">
                        <h3>{{ count($blogs) }}</h3>
                        <p>Total Pending blogs</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6  ">
                <!-- small box -->
                <div class="small-box bg-success shadow-lg rounded p-3">
                    <div class="inner">
                        <h3>{{ $statistics['totalblogs'] }}</h3>
                        <p>Total Blogs</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6  ">
                <!-- small box -->
                <div class="small-box bg-warning shadow-lg rounded p-3">
                    <div class="inner">
                        <h3>0</h3>
                        <p>views</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6  ">
                <!-- small box -->
                <div class="small-box bg-danger  shadow-lg rounded p-3">
                    <div class="inner">
                        <h3>0</h3>
                        <p>Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div id="dashboard">

            @if (count($blogs))
            <div class="row">
                <div class="col-12">
                    <h1>Pending Blogs</h1>
                </div>
                <div class="col-12">
                    <div class=" shadow-lg p-3  bg-white  ">
                        <div class="   ">
                            <input type="text" name="serach" id="serach" class="form-control rounded-pill"
                                placeholder="Search" />
                            <small>Search by blog Title, slug</small>
                        </div>
                    </div>
                </div>

                    {{-- <div class="col-8">
                        <h1>Pending Blogs</h1>
                    </div>
                    <div class=" shadow-lg p-3  bg-white  ">
                        <div class="   ">
                            <input type="text" name="serach" id="serach" class="form-control rounded-pill"
                                placeholder="Search" />
                            <small>Search by blog Title, slug</small>
                        </div>

                    </div> --}}

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
                                                        <span id="name_icon"></span>
                                                    </th>
                                                    {{-- <th>Blog Title</th> --}}
                                                    <th>Writer</th>
                                                    <th>categories </th>
                                                    <th>views </th>
                                                    <th>cover image</th>
                                                    <th>Published Date</th>
                                                    <th> Blog Status</th>
                                                    <th data-orderable="false">Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody id="tabledata">

                                                @include('backend.blog.table')

                                            </tbody>
                                        </table>
                                        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                                        <input type="hidden" name="hidden_column_name" id="hidden_column_name"
                                            value="id" />
                                        <input type="hidden" name="hidden_sort_type" id="hidden_sort_type"
                                            value="asc" />

                                        <input type="hidden" name="hidden_table_name" id="hidden_table_name"
                                            value="dashboard" />
                                        {{-- {!! $blogs->links() !!} --}}
                                    </div>
                                </div>
                            @else
                                @if (Auth::user()->role == 'admin')
                                    <div class="col-12 mt-3 p-3">
                                        <div class="container mt-4">
                                            <h1 class="text-center">You don't have blogs to <a
                                                    href="{{ route('blog.index') }}">
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

                                <script src="{{ asset('assets/custom_js/redirect_table.js') }}"></script>
                @endif

            </div>
        </div>


    </div>
    </section>


@endsection
