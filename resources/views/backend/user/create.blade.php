@extends('backend.layout.master')

@section('title', 'create user')
@section('path', 'create user')
@section('Pagename', 'User')


@section('maindata')


<div class="container">
  <div class="row">
    <h2 class="mt-5">Create User</h2>
    <div class="col-md-12">
      <h6 class="text-danger"> Password will send to user via mail</h6>
      <div class="card card-primary shadow-lg mb-5 bg-white rounded">
        <div class="card-header">
          <h3 class="card-title">User </h3><br>
        </div>
        <form action="{{route('user.store')}}" method="post" id="storeUser">
          @csrf

          <div class="card-body">

            <div class="form-group">
              <label for="title">name</label>
              <input type="name" class="form-control" placeholder="Enter name" name="name" id="title">
              @if($errors->has('name'))
              <div class="error text-danger">{{ $errors->first('name') }}</div>
              @endif
            </div>

            <div class="form-group">
              <label for="title">email</label>
              <input type="email" class="form-control" placeholder="Enter email" name="email" id="title">
              @if($errors->has('email'))
              <div class="error text-danger">{{ $errors->first('email') }}</div>
              @endif
            </div>

            <div class="form-group">
              <label for="title">phone</label>
              <input type="tel" class="form-control" placeholder="Enter phone number" name="phone" id="title">
              @if($errors->has('phone'))
              <div class="error text-danger">{{ $errors->first('phone') }}</div>
              @endif
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>

</script>
@endsection
@section('links')

    <script src="{{ asset('assets/custom_js/validate/userCreate.js') }}"></script>

@endsection
