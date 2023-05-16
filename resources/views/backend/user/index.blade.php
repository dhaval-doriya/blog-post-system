@extends('backend.layout.master')

@section('title', ' users')

@section('path', ' users')
@section('Pagename', 'User')

@section('maindata')
    <div id="dashboard">
        <div class="row card">
            <div class="col-12 d-flex justify-content-between rounded shadow-lg p-3 ">

                <div class="col-6 mb-3">
                </div>

                <div class="col-6 d-flex justify-content-end  ">
                    <div>
                        <a href="{{ route('user.create') }}" class="nav-link">
                            <button type="button" class="ms-2 btn btn-primary"><i class="fa fa-plus" aria-hidden="true">
                                </i></button>
                        </a>
                    </div>
                    <br>
                    <div class="  ">

                        <input type="text" name="serach" id="serach"  class="form-control rounded-pill" placeholder="Search"/>
                        <small>Search by User name, email , phone </small>
                    </div>
                </div>

            </div>

            <div class="col-12 mt-3">

                @if (count($users))
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="card-body">
                            <div id="item-lists">
                                @if (count($users))
                                    <div class="table">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Profile</th>
                                                    <th class="sorting" data-sorting_type="asc" data-column_name="name"
                                                        style="cursor: pointer">
                                                        name
                                                        <span id="name_icon"><i class="fa fa-angle-up" aria-hidden="true"></i></span>
                                                    </th>
                                                    <th class="sorting" data-sorting_type="asc" data-column_name="email"
                                                        style="cursor: pointer">
                                                        email
                                                        <span id="email_icon"><i class="fa fa-angle-up" aria-hidden="true"></i></span>
                                                    </th>
                                                    <th class="sorting" data-sorting_type="asc" data-column_name="phone"
                                                    style="cursor: pointer">
                                                    phone
                                                    <span id="phone_icon"><i class="fa fa-angle-up" aria-hidden="true"></i></span>
                                                </th>
                                                    <th>Total blogs</th>
                                                    <th>Total Views</th>
                                                    <th class='notexport' data-orderable="false">Actions </th>
                                                    <th class='notexport' data-orderable="false">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tabledata">

                                                @include('backend.user.table')
                                            </tbody>
                                        </table>




                                    </div>
                                @else
                                    <div class="container">
                                        <h1 class="text-center">Don't have User <a href="{{ route('user.create') }}">
                                                Click here to Create
                                            </a></h1>
                                    </div>
                                    <script src="{{ asset('assets/custom_js/redirectTable.js') }}"></script>
                                @endif

                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                    <input type="hidden" name="hidden_table_name" id="hidden_table_name"
                    value="user" />
                    @else
                    <div class="container">
                        <h1 class="text-center">Currently Don't have any User <a href="{{ route('user.create') }}">
                                Click here to Create
                            </a></h1>
                    </div>
                @endif
            </div>
        </div>
    </div>




@endsection
