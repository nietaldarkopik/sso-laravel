  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top header-scrolled bg-warning pb-0">
      <div class="container-fluid container-xl d-flex align-items-center justify-content-between rounded-top-3 bg-light py-2 border-bottom-primary border-bottom border-warning">
            <a href="{{ url('/') }}" class="logo align-items-center d-flex lh-1">
                <img src="{{ asset('front/img/logo.png')}}" alt="">
                <div>
                    <h5 class="poppins-bold text-dark fs-6 fw-bolder lh-1">@yield('web-name', 'Sistem Presensi Dosen dan Tendik')</h5>
                    <h4 class="poppins-regular text-dark fs-6 lh-1 logo-subtitle">@yield('web-subname2', 'Universitas Winaya Mukti')</h4>
                </div>
            </a>

          <nav id="navbar" class="navbar">
              @include ('front.partials.main-menu1')
              <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->

      </div>
  </header><!-- End Header -->
