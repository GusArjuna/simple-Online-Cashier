<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ $title }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ url('img/favicon.png') }}" rel="icon">
  <link href="{{ url('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ url('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ url('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ url('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ url('vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ url('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ url('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ url('vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ url('css/style.css') }}" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ url('/') }}" class="logo d-flex align-items-center">
        <img src="{{ url('img/logo.png') }}" alt="">
        <span class="d-none d-lg-block">Kelontong Istimewa</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    @yield('search')
    <!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ url('img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>


            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ url('/') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Data Toko</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ url('/foods') }}">
              <i class="bi bi-circle"></i><span>Makanan</span>
            </a>
          </li>
          <li>
            <a href="{{ url('/foodCategories') }}">
              <i class="bi bi-circle"></i><span>Kelompok Makanan</span>
            </a>
          </li>
          <li>
            <a href="{{ url('/suppliers') }}">
              <i class="bi bi-circle"></i><span>Supplier</span>
            </a>
          </li>
          <li>
            <a href="{{ url('/members') }}">
              <i class="bi bi-circle"></i><span>Pelanggan / Member</span>
            </a>
          </li>
          <li>
            <a href="{{ url('/inventories') }}">
              <i class="bi bi-circle"></i><span>Gudang</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-heading">Transaksi & Laporan</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/buyFractures') }}">
          <i class="bi bi-cart-plus-fill"></i>
          <span>Fraktur Beli</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/sellFractures') }}">
          <i class="bi bi-cart-dash-fill"></i>
          <span>Fraktur Jual</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/sellReturns') }}">
          <i class="ri-shopping-cart-fill"></i>
          <span>Retur Jual</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/buyReturns') }}">
          <i class="ri-shopping-cart-line"></i>
          <span>Retur Beli</span>
        </a>
      </li><!-- End Register Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    @yield('pagetitle')

    <section class="section dashboard">
      <div class="row">

        @yield('bagan')

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Aji Wibowo</span></strong>. All Rights Reserved 2023
    </div>
    <div class="credits">
      Designed by Me
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ url('vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ url('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ url('vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ url('vendor/quill/quill.min.js') }}"></script>
  <script src="{{ url('vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ url('vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ url('vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ url('js/main.js') }}"></script>
  @yield('javas')
</body>

</html>