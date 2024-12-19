<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | SPK Mayora </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ asset('adminLTE3/dist/img/favicon.png') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminLTE3/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminLTE3/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <style>
    body {
  margin: 0;
    font: normal 75% Arial, Helvetica, sans-serif;
  }
  canvas {
    display: block;
    vertical-align: bottom;
  }
  /* ---- tsparticles container ---- */
  #tsparticles {
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: #0d47a1;
    background-image: url("");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: 50% 50%;
  }

  .github {
    bottom: 10px;
    right: 10px;
    position: fixed;
    border-radius: 10px;
    background: #fff;
    padding: 0 12px 6px 12px;
    border: 1px solid #000;
  }

  .github a:hover,
  .github a:link,
  .github a:visited,
  .github a:active {
    color: #000;
    text-decoration: none;
  }

  .github img {
    height: 30px;
  }
  .login-logo a, .register-logo a {
      color: #fff!important;
  }
  .login-box, .register-box {
      width: 360px;
      z-index: 999;
  }
  .github #gh-project {
    font-size: 20px;
    padding-left: 5px;
    font-weight: bold;
    vertical-align: bottom;
  }
    </style>
</head>
<body class="hold-transition login-page" id="tsparticles">
  {{-- <div class="-logo">
    <img src="{{ asset('adminLTE3/dist/img/logos.png')}}" width="112" class="img-logo" />
  </div> --}}
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Aplikasi SPK</b> </a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silahkan Login menggunakan Akun Pengguna</p>
      @if ($errors->any())
          @foreach ($errors->all() as $error)
              <div class="text-danger" style="padding-bottom: 13px">
                Email atau Password Anda tidak Valid
              </div>
          @endforeach 
      @endif

    <form action="{{ route('login')}}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Login </button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('adminLTE3/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminLTE3/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminLTE3/dist/js/adminlte.min.js')}}"></script>

<script>
const form = document.querySelector('form');
form.addEventListener('submit', function(event) {
    const email = document.querySelector('input[name="email"]').value;
    const password = document.querySelector('input[name="password"]').value;

    if (email.trim() === '' || password.trim() === '') {
        event.preventDefault(); 
        Swal.fire("error!", "Email dan password harus diisi", "error");
    }
});
</script>
</body>
</html>

