@extends('backend.layout.master')

@section('title', 'Profile')
@section('path', 'Profile')
@section('Pagename', 'User')




@section('maindata')
<section class="content container-fluid">

  <div class="row ">
    <div class="col-12 ">

      <div class="card card-widget widget-user mt-5 m-5">
        <div class="widget-user-header text-white" style="background: LightGray url( 'https://images.unsplash.com/photo-1520190282873-afe1285c9a2a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1206&q=80') center center; height: 150px">
          <h3>
            <div class="widget-user-username text-right">
              <a href="{{route('user.update',['id'=>$user ?? ''->id])}}">
                <button type="button" class="ms-2 btn btn-primary">Update Details</button>
              </a>
            </div>
          </h3>
        </div>
        <div class="widget-user-image">
          @if($user->profile_image)
          <img class="img-circle" src="{{asset('profile-images/'. $user->profile_image ) }}" alt="User Avatar">
          @else
          <img class="img-circle" src="{{asset('assets/dashboard/dist/img/user2-160x160.jpg')}}" alt="User Avatar">
          @endif
        </div>
        <div class="card-footer">

          <div class="row">
            <div class="col-12 d-flex justify-content-center">
              <h3 class="widget-user-username text-right">{{$user->name}}</h3>
            </div>
            <div class="col-12 d-flex justify-content-center">
              <h5 class="widget-user-desc text-right">{{$user->role}}</h5>
            </div>

            <div class="col-sm-4 border-right">
              <div class="description-block">
                <h5 class="description-header">{{count($user->blogs)}}</h5>
                <span class="description-text">Total blogs</span>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 border-right">
              <div class="description-block">
                <h5 class="description-header">

                  <td>0</td>
                </h5>
                <span class="description-text">Total Blog Views</span>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="description-block">
                <h5 class="description-header">35</h5>
                <span class="description-text">Followers</span>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>


    <!-- /.col-->
  </div>
  <!-- ./row -->
</section>
@endsection
