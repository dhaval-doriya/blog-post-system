@extends('backend.layout.master')

@section('title', 'Admin Dashboard')

@section('path', 'Admin Dashboard')
@section('Pagename', 'Admin Dashboard')


@section('maindata')


    <div class="row">
        <div class="col-lg-3 col-6 ">
            <div class="small-box bg-info shadow-lg rounded p-3">
                <div class="inner">
                    <h3>{{ count($blogs) }}</h3>

                    <p>Pending Blogs</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('dashboard') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6 ">
            <div class="small-box bg-success shadow-lg rounded p-3">
                <div class="inner">
                    <h3>{{ $statistics['totalblogs'] ?? '3' }}
                    </h3>

                    <p>Total Blogs</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('blog.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6 ">
            <div class="small-box bg-warning shadow-lg rounded p-3">
                <div class="inner">
                    <h3>{{ $statistics['totalusers'] ?? 3 }}</h3>
                    <p>Total User </p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('user.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6 ">
            <div class="small-box bg-danger shadow-lg rounded p-3">
                <div class="inner">
                    <h3>{{ $statistics['totalcategories'] ?? '4' }}</h3>
                    <p>Total categories</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('category.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div id="dashboard">
        @if (count($blogs))
            <div class="col-12">
                <h1>Blogs</h1>
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


            <div class="col-12 mt-3">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <div id="item-lists">
                            <div class="table">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>name</th>
                                            <th>user_name</th>
                                            <th>image</th>
                                            <th>views </th>
                                            <th>created_at</th>
                                            <th>Status</th>
                                            <th> Approve Blog</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabledata">
                                        @include('backend.layout.admintable')
                                    </tbody>

                                </table>
                            </div>
                            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                            <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                            <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />

                            <input type="hidden" name="hidden_table_name" id="hidden_table_name" value="dashboard" />
                            {{-- {!! $blogs->links() !!} --}}
                        </div>
                    </div>
                </div>
            </div>
        @else
            <script src="{{ asset('assets/custom_js/redirectTable.js') }}"></script>

            <div class="container">
                <h1 class="text-center">You don't have any blogs to Approve <a href="{{ route('blog.all') }}">
                        Click here to view
                    </a></h1>
            </div>
        @endif

    </div>


@endsection
