<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> @yield('title')</title>


  @include('backend.layout.headlinks')
  @include('backend.layout.commanlinks')
  @yield('headerlinks')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    @include('backend.layout.navbar')

    @include('backend.layout.sidebar')

    <div class="content-wrapper">
      <section class="content ">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-10">
                <h1 class="m-0"> @yield('Pagename')</h1>
              </div>
              {{-- {{ ucfirst(trans(Auth::user()->role))}} Dashboard  --}}
              <div class="col-sm-2">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active"> @yield('path')</li>
                  <li>
                  </li>
                </ol>

              </div>
            </div>
          </div>
        </div>
        @yield('maindata')
      </section>
    </div>
    @include('backend.layout.footer')
  </div>
</body>
@yield('links')

</html>
