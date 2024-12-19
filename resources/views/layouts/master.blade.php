<!DOCTYPE html>
<html>
<head>
  @include('layouts.head')
</head>
<body class="sidebar-mini layout-fixed">
<div class="wrapper">
    @include('layouts.header')
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- sidebar: style can be found in sidebar.less -->
    @include('layouts.sidebar')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  @include('sweetalert::alert')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $title }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Beranda</a></li>
              <li class="breadcrumb-item active">{{ $subtitle }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ $subtitle }}</h3>
              </div>

              @yield('content')
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
    <!-- /.content -->
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.2
    </div>
    <strong>SPK Mayora &copy; 2024 </a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
  
@include('layouts.script')
@yield('scripts')
</body>
</html>
