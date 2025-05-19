<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    <nav id="sidebar">
      <!-- Sidebar Header-->
      <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="{{ asset('admin/img/avatar-6.jpg') }}" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
          <h1 class="h5">Admin | Dashboard</h1>

        </div>
      </div>
      <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
      <ul class="list-unstyled">
              <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                  <a href="{{ route('dashboard') }}"> <i class="icon-home"></i>Home </a>
              </li>

              <li class="{{ request()->routeIs('admin.add_coffee') || request()->routeIs('admin.view_coffee') || request()->routeIs('admin.availability_coffee') ? 'active' : '' }}">
                  <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i> Coffee </a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled {{ request()->routeIs('admin.add_coffee') || request()->routeIs('admin.view_coffee') || request()->routeIs('admin.availability_coffee') ? 'show' : '' }}">
                    <li><a href="{{ route('admin.add_coffee') }}">Add Coffee</a></li>
                    <li><a href="{{ route('admin.view_coffee') }}">View Coffee</a></li>
                    <li><a href="{{ route('admin.availability_coffee') }}">Coffee Availability</a></li>
                    <li><a href="#">Promo</a></li>

                  </ul>
              </li>

              <li class="{{ request()->routeIs('admin.add_food') || request()->routeIs('admin.view_food') || request()->routeIs('admin.availability_food') || request()->routeIs('admin.promo_food') ? 'active' : '' }}">
                  <a href="#foodDropdown" aria-expanded="false" data-toggle="collapse">
                      <i class="icon-windows"></i> Food
                  </a>
                  <ul id="foodDropdown" class="collapse list-unstyled {{ request()->routeIs('admin.add_food') || request()->routeIs('admin.view_food') || request()->routeIs('admin.availability_food') || request()->routeIs('admin.promo_food') ? 'show' : '' }}">
                      <li><a href="{{ route('admin.add_food') }}">Add Food</a></li>
                      <li><a href="{{ route('admin.view_food') }}">View Food</a></li>
                      <li><a href="{{ route('admin.availability_food') }}">Food Availability</a></li>
                      <li><a href="{{ route('admin.promo_food') }}">Promo</a></li>
                  </ul>
              </li>

              <li class="{{ request()->routeIs('admin.add_stock') || request()->routeIs('admin.view_stock') || request()->routeIs('admin.stock_history') || request()->routeIs('admin.stock_usage_report') ? 'active' : '' }}">
                  <a href="#stockInDropdown" aria-expanded="false" data-toggle="collapse">
                      <i class="icon-windows"></i> Stocks
                  </a>
                  <ul id="stockInDropdown" class="collapse list-unstyled {{ request()->routeIs('admin.add_stock') || request()->routeIs('admin.view_stock') || request()->routeIs('admin.stock_history') || request()->routeIs('admin.stock_usage_report') ? 'show' : '' }}">
                      <li><a href="{{ route('admin.add_stock') }}">Add Stock</a></li>
                      <li><a href="{{ route('admin.view_stock') }}">View Stocks</a></li>
                      <li><a href="{{ route('admin.stock_history') }}">Stock History</a></li>
                      <li><a href="{{ route('admin.stock_usage_report') }}">Stock Usage Report</a></li>
                  </ul>
              </li>

      </ul>
      <span class="heading">Reports</span>
      <ul class="list-unstyled">
        <li class="{{ request()->routeIs('admin.transactions') ? 'active' : '' }}">
          <a href="{{ route('admin.transactions') }}"> <i class="icon-list"></i>Transaction List</a>
        </li>
        <li class="{{ request()->routeIs('orders') ? 'active' : '' }}">
          <a href="/orders"> <i class="icon-settings"></i>Orders</a>
        </li>
        <li class="{{ request()->routeIs('admin.sales') ? 'active' : '' }}">
          <a href="{{ route('admin.sales') }}"> <i class="icon-writing-whiteboard"></i>Sales</a>
        </li>
      </ul>
    </nav>
    <!-- Sidebar Navigation end-->
