  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="{{ base_url() }}" class="logo d-flex align-items-center">
        <span>@yield('web-name','SI-PSU')</span>
      </a>

      <nav id="navbar" class="navbar">
        @include ('front.partials.main-menu1');?>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
