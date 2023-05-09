

<nav class="main-header navbar navbar-expand navbar-white navbar-light pb-4">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <a class="nav-link " data-toggle="dropdown" href="#">
      <div class="user-panel pb-2 mb-2 d-flex ">
        <p>
          {{Auth::user()->name}}

        </p>
        <div class="image">
          @if(Auth::user()->profile_image)
          <img src="  {{ asset('profile-images/'. Auth::user()->profile_image )}}" class="img-circle  " alt="User Image" height="160px" width="160px">
          @else
          <img src="{{ asset('assets/dashboard/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2 " alt="User Image">
          @endif
        </div>
      </div>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <div class="dropdown-divider"></div>
      <a href="{{route('user.profile')}}" class="dropdown-item">
        <button class="dropdown-item"> Profile</button>
      </a>
      <div class="dropdown-divider"></div>
      <a href="{{route('password.change')}}" class="dropdown-item">
        <button class="dropdown-item">Change Password</button>
      </a>

      <div class="dropdown-divider"></div>
      <div class="dropdown-item">
        <button class="dropdown-item  user-logout" data-action="{{route('user.logout')}}">
          Log out
        </button>
      </div>

      <form class="dropdown-item" action="{{route('user.logout')}}" method="post" id="user_logout">
        @csrf
        <button hidden class="dropdown-item" type="submit" class="btn btn-"> Log out</button>
      </form>

    </div>


    <!-- Notifications Dropdown Menu -->

    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>

  </ul>
</nav>