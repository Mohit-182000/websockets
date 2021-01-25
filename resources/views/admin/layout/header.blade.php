<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- SEARCH FORM -->
   {{--  <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>--}}
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!--Multi Branch-->


        <li class="nav-item dropdown user-menu">       
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                @if($adminlogin->admin_profile != null)
                    <img class="user-image img-circle elevation-2" src="{{ $adminlogin->admin_profile }}" alt="" id="imgname">
                @else
                    <img class="user-image img-circle elevation-2" src="{{ asset('storage/demo/user1.png') }}" alt="" id="imgname">
                @endif
                <span class="d-none d-md-inline">{{ $adminlogin->name ?? ''}} </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    
                    @if($adminlogin->admin_profile != null)
                        <img class="user-image img-circle elevation-2 showcropimg" src="{{ $adminlogin->admin_profile }}" alt="" id="imgname">
                    @else
                        <img class="user-image img-circle elevation-2" src="{{ asset('storage/demo/user1.png') }}" alt="" id="imgname">
                    @endif

                    <p>
                        {{ $adminlogin->name ?? ''}}

                    </p>
                </li>
                <!-- Menu Body -->

                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="{{ route('admin.overview.index') }}" class="btn btn-default btn-flat">Profile</a>
                    <a href="{{ url('/admin/logout') }}" class="btn btn-default btn-flat float-right"> Logout
                    </a>

                </li>
            </ul>
        </li>

    </ul>
</nav>
