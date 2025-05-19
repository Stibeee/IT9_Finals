<header class="header">
    <nav class="navbar navbar-expand-lg">
      <div class="search-panel">
        <div class="search-inner d-flex align-items-center justify-content-center">
          <div class="close-btn">Close <i class="fa fa-close"></i></div>
          <form id="searchForm" action="#">
          </form>
        </div>
      </div>
      <div class="container-fluid d-flex align-items-center justify-content-between">
        <div class="navbar-header">
          <!-- Navbar Header-->
          <a href="{{ route('dashboard') }}" class="navbar-brand">
            <div class="visible brand-text brand-big text-uppercase"><strong class="text-primary">Coffee</strong><strong>Shop</strong></div>
            <div class="brand-text brand-sm"><strong class="text-primary">C</strong><strong>S</strong></div>
          </a>
            <!-- Sidebar Toggle Btn-->
          <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
        </div>
        <!-- Log out -->
          <div class="list-inline-item logout">
          <form method="POST" action="{{ route('logout') }}">
                @csrf
            <button class="btn btn-danger" type="submit">Logout</button>
            </form>
        </div>
      </div>
    </nav>
  </header>
