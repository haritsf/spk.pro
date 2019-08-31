<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  {{-- <link rel="icon" type="image/png" href="{{url('img/logo.png')}}" sizes="32x32"> --}}
  <link rel="icon" type="image/png" href="{{url('img/favicon-32x32.png')}}" sizes="32x32">
  <link rel="icon" type="image/png" href="{{url('img/favicon-16x16.png')}}" sizes="16x16">
  <title>spk.pro - @yield('title')</title>

  <link rel="stylesheet" href="{{url('modules/datatables/datatables.min.css')}}">
  <link rel="stylesheet" href="{{url('modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{url('modules/fontawesome/css/all.min.css')}}">
  <link rel="stylesheet" href="{{url('modules/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{url('css/style.min.css')}}">
  <link rel="stylesheet" href="{{url('css/components.min.css')}}">

  <style>
    @font-face {
      font-family: Product Sans;
      src: url({{url('fonts/productsans.ttf')}});
    }
  </style>

  <script src="{{url('modules/jquery.min.js')}}"></script>
  <script src="{{url('modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{url('modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{url('modules/datatables/datatables.min.js')}}"></script>
  <script src="{{url('modules/select2/dist/js/select2.full.min.js')}}"></script>
  <script src="{{url('js/stisla.js')}}"></script>
  <script src="{{url('js/scripts.js')}}"></script>
  <script src="{{url('js/custom.js')}}"></script>

  <script src="{{url('modules/jquery-ui/jquery-ui.min.js')}}"></script>
  <script src="{{url('js/lodash.js')}}"></script>
  <script>
    $(document).ready(function() {
        $('#DataTables, #Tables').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true
        });
      });
  </script>
  <script>
    $(document).ready(function() {
        $('#Net').DataTable({
          'paging'      : false,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true
        });
      });
  </script>
  <script>
    $(document).ready(function() {
          $('#LeavingEntering').DataTable({
            'paging'      : false,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : false
          });
        });
  </script>

</head>

{{-- {{ dd(Auth::user()->username) }} --}}

<body style="font-family:Product Sans">
  <div class="main-wrapper main-wrapper-1">
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar">
      <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
          <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </li>
        </ul>
      </form>
      <ul class="navbar-nav navbar-right">
        <li class="dropdown beep"><a href="#" data-toggle="dropdown"
            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{url('img/avatar/avatar-1.png')}}" class="rounded-circle mr-2">
            <div class="d-sm-none d-lg-inline-block">Hallo, {{Auth::user()->alias}}</div>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow rounded">
            <div class="dropdown-title">Logged in 4 years ago</div>
            <a href="{{route('profile.edit', Auth::user()->id)}}" class="dropdown-item has-icon">
              <i class="far fa-user"></i> Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{route('logout')}}" class="dropdown-item has-icon text-danger">
              <i class="fas fa-sign-out-alt"></i> Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>

    <div class="main-sidebar sidebar-style-2 shadow">
      <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
          <a href="{{route('admin.dashboard')}}">promethee</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
          <a href="">pro</a>
        </div>
        <ul class="sidebar-menu">
          <li class="menu-header">Dashboard</li>
          <li class="nav-item"><a href="{{route('admin.home')}}" class="nav-link"><i
                class="fas fa-columns"></i><span>Home</span></a>
          </li>
          <li class="nav-item"><a href="{{route('pemalang.read')}}" class="nav-link"><i
                class="fas fa-map"></i><span>Pemalang</span></a>
          </li>
          <li class="menu-header">Processing</li>
          <li class="dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-server"></i><span>Data</span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="{{route('kecamatan.read')}}" class="nav-link">Kecamatan</a></li>
              <li><a href="{{route('kriteria.read')}}" class="nav-link">Kriteria</a></li>
              <li><a href="{{route('preferensi.read')}}" class="nav-link">Preferensi</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i
                class="fas fa-sliders-h"></i><span>Kriteria</span></a>
            <ul class="dropdown-menu">
              @php
              $sidebar = Kustom::MenuKriteria();
              @endphp
              @foreach ($sidebar as $kriteria)
              <li class="nav-item">
                <a href="{{route('kriteria.view', $kriteria->id)}}" class="nav-link">{{$kriteria->nama}}</a>
              </li>
              @endforeach
            </ul>
          </li>
          <li class="nav-item"><a href="{{route('klasifikasi.read')}}" class="nav-link"><i
                class="fas fa-external-link-alt"></i><span>Klasifikasi</span></a>
          </li>
          <li class="menu-header">Step by Step</li>
          <li class="nav-item dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i
                class="fas fa-diagnoses"></i><span>PROMETHEE</span></a>
            <ul class="dropdown-menu">
              <li class="nav-item">
                <a href="{{route('pro.deviasi')}}" class="nav-link">Deviasi</a>
              </li>
              <li class="nav-item">
                <a href="{{route('pro.preferensi')}}" class="nav-link">Indeks Preferensi</a>
              </li>
              <li class="nav-item">
                <a href="{{route('pro.leavingentering')}}" class="nav-link">Leaving & Entering Flow</a>
              </li>
              <li class="nav-item">
                <a href="{{route('pro.net')}}" class="nav-link">Net Flow</a>
              </li>
            </ul>
          </li>
          <?php
              if (Auth::user()->role == "Adminstrator") 
              { ?>
          <li class="menu-header">Options</li>
          <li class="nav-item"><a href="{{route('pengguna.read')}}" class="nav-link"><i
                class="far fa-user"></i><span>Users</span></a>
          </li>
          <?php    }
          ?>
        </ul>
      </aside>
    </div>

    <div class="main-content">
      <section class="section">
        <div class="row">
          <div class="container-fluid">
            {{-- <div class="hero bg-light"></div> --}}
            <div class="container">
              <div class="breadcrumb shadow">
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item">@yield('pages')</li>
                <li class="breadcrumb-item active">@yield('title')</li>
              </div>
            </div>

            <h1 class="text-center pt-auto pb-3" style="font-weight: 400">@yield('title')</h1>

            @yield('content')

            <footer class="main-footer">
              <div class="footer-right">
                Copyright &copy; 2019 <div class="bullet"></div> Design By <a href="https://instagram.com/harits.f/"
                  target="_blank">haritsf</a> Powered by Stisla
              </div>
            </footer>
          </div>
        </div>
      </section>
    </div>

</body>

</html>