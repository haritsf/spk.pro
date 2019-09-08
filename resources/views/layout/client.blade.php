<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
    name="viewport">
  <title>spk.pro</title>
  <link rel="icon" type="image/png" href="{{url('img/favicon-32x32.png')}}" sizes="32x32">
  <link rel="icon" type="image/png" href="{{url('img/favicon-16x16.png')}}" sizes="16x16">
  <link rel="stylesheet" href="{{url('modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{url('modules/bootstrap-social/bootstrap-social.css')}}">
  <link rel="stylesheet" href="{{url('modules/fontawesome/css/all.min.css')}}">
  <link rel="stylesheet" href="{{url('css/style.min.css')}}">
  <link rel="stylesheet" href="{{url('css/components.min.css')}}">
  {{-- <link rel="stylesheet" href="{{url('css/style.css')}}">
  <link rel="stylesheet" href="{{url('css/components.css')}}"> --}}
  <link rel="stylesheet" href="{{url('css/custom.css')}}">
  <link rel="stylesheet" href="{{url('css/landing.css')}}">
  <link rel="stylesheet" href="{{url('css/aos.css')}}">
  <link rel="stylesheet" href="{{url('css/animate.css')}}">
  <link rel="stylesheet" href="{{url('modules/datatables/datatables.min.css')}}">

  <script src="{{url('modules/datatables/datatables.min.js')}}"></script>
  <script src="{{url('modules/jquery.min.js')}}"></script>
  <script src="{{url('modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{url('js/stisla.js')}}"></script>
  <script src="{{url('js/landing.js')}}"></script>
  <script src="{{url('js/aos.js')}}"></script>

  <style>
    @font-face {
      font-family: Product Sans;
      src: url({{url('fonts/productsans.ttf')}});
    }
  </style>

<script>
  $(document).ready(function() {
      $('#DataTables').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
      });
    });
</script>

</head>

<body class="" style="font-family:Product Sans">
  <nav class="navbar navbar-reverse navbar-expand-lg" style="position: absolute;">
    <div class="container">
      <div class="collapse navbar-collapse">
        <a class="navbar-brand smooth" href="{{route('landing')}}">promethee</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>

        <ul class="navbar-nav mr-auto ml-lg-3 align-items-lg-center" style="font-weight:normal">
          <li class="nav-item">
            <a href="{{route('client.data')}}" class="nav-link">Data</a>
          </li>
          <li class="nav-item">
            <a href="{{route('client.analisa')}}" class="nav-link">Analisa</a>
          </li>
          <li class="nav-item">
            <a href="{{route('client.pemalang')}}" class="nav-link">Pemalang</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto align-items-lg-center d-none d-lg-block">
          <li class="ml-lg-3 nav-item">
            <a href="{{ route('login') }}" class="btn btn-md btn-round btn-icon icon-left">
              <i class="fab fa-stumbleupon"></i> Login
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <h3 class="text-capitalize" style="font-weight:500">promethee</h3>
          <div class="pr-lg-5">
            <p>promethee was created by <a href="https://twitter.com/haritsf">Harits Fathuddin</a>
              to help developers create their own Decision for Critical Land. promethee is free for anyone,
              support us by becoming a sponsor and keeping this project alive.</p>
            <p>&copy; Stisla. With <i class="fas fa-heart text-danger"></i> from Indonesia</p>
            <div class="mt-4 social-links">
              <a href="https://github.com/stisla"><i class="fab fa-github"></i></a>
              <a href="https://twitter.com/getstisla"><i class="fab fa-twitter"></i></a>
            </div>
          </div>
        </div>
        {{-- <div class="col-md-7">
          <div class="row">
            <div class="col-md-4">
              <h4>Core</h4>
              <ul>
                <li><a href="http://demo.getstisla.com/index.html">Dashboard</a></li>
                <li><a href="http://demo.getstisla.com/layout-transparent.html">Layouts</a></li>
                <li><a href="http://demo.getstisla.com/bootstrap-alert.html">Bootstrap</a></li>
                <li><a href="http://demo.getstisla.com/components-article.html">Components</a></li>
                <li><a href="http://demo.getstisla.com/modules-calendar.html">Third-party Libraries</a>
                </li>
                <li><a href="http://demo.getstisla.com/features-activities.html">Pre-built Pages</a>
                </li>
                <li><a href="javascript:;">Skeleton (Progress)</a></li>
              </ul>
            </div>
            <div class="col-md-4">
              <h4>Developers</h4>
              <ul>
                <li><a href="https://getstisla.com/getting-started">Get Started</a></li>
                <li><a href="https://getstisla.com/download" target="_blank">Download</a></li>
                <li><a href="https://getstisla.com/docs">Documentation</a></li>
                <li><a href="https://getstisla.com/support">Support</a></li>
              </ul>
            </div>
            <div class="col-md-4">
              <h4>Company</h4>
              <ul>
                <li><a href="https://getstisla.com/blog">Blog</a></li>
                <li><a href="https://getstisla.com/page/about">About</a></li>
                <li><a href="https://getstisla.com/page/contact">Contact Us</a></li>
                <li><a href="https://github.com/stisla/stisla/graphs/contributors">Team</a></li>
              </ul>
            </div>
          </div>
        </div> --}}
      </div>
    </div>
  </footer>

  <script>
    AOS.init();
  </script>
  <script src="{{url('js/jquery.nav.js')}}"></script>
  <script>
    $(document).ready(function() {
          $('#nav').onePageNav();
      });
  </script>

</body>

</html>