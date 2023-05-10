<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (Auth::user()->profile_image)
                    <img src="  {{ asset('profile-images/' . Auth::user()->profile_image) }}"
                        class="img-circle  elevation-2" alt="User Image">
                @else
                    <img src="{{ asset('assets/dashboard/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="{{ route('dashboard') }}" class="d-block"> {{ Auth::user()->name }}</a>
            </div>
        </div>
        <div class="form-inline"></div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt" aria-hidden="true"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @if (auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('category.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-th-list" aria-hidden="true"></i>
                            <p>Category</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                            <p> Users</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('blog.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-list-alt" aria-hidden="true"></i>
                            <p> Blogs</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->role == 'user')
                    <li class="nav-item">
                        <a href="{{ route('blog.create') }}" class="nav-link">
                            <i class="nav-icon  fa fa-plus-square" aria-hidden="true"></i>
                            <p>Create Blog</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('blog.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-list-alt" aria-hidden="true"></i>
                            <p>All blogs</p>
                        </a>
                    </li>
                @endif


                <li class="nav-item">
                    <a href="{{ route('blog.all') }}" class="nav-link">
                        <i class="nav-icon  fa fa-home" aria-hidden="true"></i>
                        <p> Visit Homepage</p>
                    </a>
                </li>


            </ul>
        </nav>
    </div>

</aside>
