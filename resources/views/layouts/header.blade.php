<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
    <a href="#" class="nav-link">{{ $title }}</a>
    </li>
  </ul>
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="{{ asset('adminLTE3/dist/img/user_icon.png')}}" class="user-image" alt="User Image">
          <span class="hidden-xs">{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="{{ asset('adminLTE3/dist/img/user_icon.png')}}" class="img-circle" alt="User Image">
            <p>
              {{ Auth::user()->name }}
            </p>
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <div>
              Login sebagai : &nbsp;<b>{{ Auth::user()->role }}</b>
            </div>
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="{{ url('profil') }}" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
              <a href="{{ url('logout') }}" class="btn btn-default btn-flat">Logout</a>
            </div>
          </li>
        </ul>
      </li>
    </ul>
  </div>
 
  </ul>
</nav>
<!-- /.navbar -->