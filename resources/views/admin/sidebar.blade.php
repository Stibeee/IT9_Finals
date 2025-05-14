<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    <nav id="sidebar">
      <!-- Sidebar Header-->
      <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="admin/img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
          <h1 class="h5">Admin | Dashboard</h1>

        </div>
      </div>
      <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
      <ul class="list-unstyled">
              <li class="active"><a href="{{ ('home') }}"> <i class="icon-home"></i>Home </a></li>

              <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i> Coffee </a>
                <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                  <li><a href="{{ ('add_coffee') }}">Add Coffee</a></li>
                  <li><a href="{{ ('view_coffee') }}">View Coffee</a></li>
                  <li><a href="{{('availability') }}">Coffee Availability</a></li>
                  <li><a href="#">Promo</a></li>

                </ul>
              </li>

              <li>
                <a href="#foodDropdown" aria-expanded="false" data-toggle="collapse"> 
                    <i class="icon-windows"></i> Food 
                </a>
                <ul id="foodDropdown" class="collapse list-unstyled">
                    <li><a href="{{ route('admin.add_food') }}">Add Food</a></li>
                    <li><a href="{{ route('admin.view_food') }}">View Food</a></li>
                    <li><a href="{{ route('admin.availability_food') }}">Food Availability</a></li>
                    <li><a href="{{ route('admin.promo_food') }}">Promo</a></li>
                </ul>
            </li>

            <li>
                <a href="#stockInDropdown" aria-expanded="false" data-toggle="collapse"> 
                    <i class="icon-windows"></i> Stocks 
                </a>
                <ul id="stockInDropdown" class="collapse list-unstyled">
                    <li><a href="{{ route('admin.add_stock') }}">Add Stock</a></li>
                    <li><a href="{{ route('admin.view_stock') }}">View Stocks</a></li>
                    <li><a href="{{ route('admin.stock_history') }}">Stock History</a></li>
                    <li><a href="{{ route('admin.stock_usage_report') }}">Stock Usage Report</a></li>
                </ul>
            </li>

      <ul class="list-unstyled">
        <li> <a href="{{('transactions') }}"> <i class="icon-list"></i>Transaction List</a></li>
        <li> <a href="#"> <i class="icon-settings"></i>Orders</a></li>
        <li> <a href="#"> <i class="icon-writing-whiteboard"></i>Sales</a></li>

      </ul>
    </nav>
    <!-- Sidebar Navigation end-->
