  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('admin.dashboard')}}" class="nav-link">Home</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">
                {{Auth::guard('admin')->user()->unReadnotifications->count()}}
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">
            {{Auth::guard('admin')->user()->unReadnotifications->count()}}
                Notifications</span>
            <div class="dropdown-divider"></div>
            @foreach(Auth::guard('admin')->user()->unReadnotifications as $notification)
            <a href="{{route('admin.view.orders')}}" class="dropdown-item"> New Order by &nbsp;&nbsp;{{$notification->data['orders']['productDetails']['name']}}</a>

            @endforeach

            <div class="dropdown-divider"></div>
            <a href="{{url('admin/markasread')}}" class="dropdown-item dropdown-footer">Mark as Read All</a>
          </div>
        </li>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link"  href="{{route('admin.logout')}}">
          logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
