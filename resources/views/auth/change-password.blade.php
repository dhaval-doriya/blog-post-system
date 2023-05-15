@extends('backend.layout.master')

@section('title', 'Change Password')
@section('path', 'Change Password')


@section('maindata')

    <div class="container">
        <div class="row">


            <div class="col-md-12">
                <h1 class="mt-5">
                    Change Password </h1>

                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Change Password</h3>
                    </div>

                    <form id="change-password" action="{{ route('auth.password.change', ['id' => Auth::user()->id]) }}"
                        method="post">
                        @csrf
                        <div class="card-body">
                            @if ($errors->has('msg'))
                                <h4 class="error text-danger">{{ $errors->first('msg') }}</h4>
                            @endif
                            <div class="form-group">
                                <label for="name">Current Password</label>
                                <input type="password" class="form-control" placeholder="Enter Current Password"
                                    name="old_password" id="old_password" required>
                                @if ($errors->has('old_password'))
                                    <div class="error text-danger">{{ $errors->first('old_password') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password">Enter New Password</label>
                                <input type="password" class="form-control" placeholder="Enter New Password" name="password"
                                    id="password" required>
                                @if ($errors->has('password'))
                                    <div class="error text-danger">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Enter New Password Again</label>
                                <input type="password" class="form-control" placeholder="Enter New Password"
                                    name="confirm_password" id="confirm_password" required>
                                @if ($errors->has('confirm_password'))
                                    <div class="error text-danger">{{ $errors->first('confirm_password') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('links')
    <script src="{{ asset('assets/custom_js/validate/userAuthenticate.js') }}"></script>


@endsection
