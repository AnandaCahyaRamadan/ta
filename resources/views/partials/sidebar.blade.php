<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
          <div class="sb-sidenav-menu">
              <div class="nav">
                  <div class="sb-sidenav-menu-heading">Core</div>
                  @if (Auth::user()->roles->role_name == 'admin')
                  <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                      <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                      Dashboard
                  </a>
                  @endif
                  <a class="nav-link {{ Request::is('sliders') ? 'active' : '' }}" href="/sliders">
                    <div class="sb-nav-link-icon"><i class="fas fa-image"></i></div>
                    Slider
                  </a>

                  <div class="sb-sidenav-menu-heading">Management</div>
                  @if (Auth::user()->roles->role_name == 'admin')
                  <a class="nav-link {{ Request::is('categories') || Request::is('products') ? 'active' : '' }} collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts">
                      <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                      Product
                      <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                      <nav class="sb-sidenav-menu-nested nav">
                          <a class="nav-link {{ Request::is('categories') ? 'active' : '' }}" href="/categories">Category</a>
                          <a class="nav-link {{ Request::is('products') ? 'active' : '' }}" href="/products">Products</a>
                      </nav>
                  </div>
                  @else
                  <a class="nav-link {{ Request::is('products') ? 'active' : '' }}" href="/products">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                    Product
                  </a>
                  @endif
                  @can('admin')
                  <a class="nav-link {{ Request::is('roles') || Request::is('users') ? 'active' : '' }}  collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                      <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                      User
                      <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                      <nav class="sb-sidenav-menu-nested nav">
                          <a class="nav-link {{ Request::is('roles') ? 'active' : '' }}" href="/roles">Role</a>
                          <a class="nav-link {{ Request::is('users') ? 'active' : '' }}" href="{{ route('users.index')}}">Tambah user</a>
                      </nav>
                  </div>
                  @endcan
              </div>
          </div>
          <div class="sb-sidenav-footer">
              <div class="small">Logged in as:</div>
              {{ auth()->user()->name }}
          </div>
      </nav>
  </div>