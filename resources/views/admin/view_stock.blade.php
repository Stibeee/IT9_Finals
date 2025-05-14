<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid">
          <h1 class="text-white mb-4;">Stock Management</h1>
          <div class="mb-4">
                <form id="searchForm">
                    <div class="input-group" style="max-width: 500px; margin: 30px; padding: 20px;">
                        <input type="text" name="search" id="searchInput" class="form-control" 
                            placeholder="Search ingredients..." autocomplete="off">
                    </div>
                </form>
            </div>
        </div>
      </div>
      
      <section class="no-padding-top">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="block">
                <div class="title">
                  <strong class="d-block">Current Stock Inventory</strong>
                  <span class="d-block">Manage your ingredients inventory</span>
                </div>

                <div class="table-responsive">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Ingredient Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Minimum Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($stocks as $stock)
                      <tr>
                        <td>{{$stock->id}}</td>
                        <td>{{$stock->ingredient_name}}</td>
                        <td>{{$stock->quantity}}</td>
                        <td>{{$stock->unit}}</td>
                        <td>{{$stock->minimum_stock}}</td>
                        <td>
                          @if($stock->quantity <= $stock->minimum_stock)
                            <span class="badge badge-danger">Low Stock</span>
                          @else
                            <span class="badge badge-success">In Stock</span>
                          @endif
                        </td>
                        <td>
                          <a href="{{url('update_stock', $stock->id)}}" class="btn btn-warning btn-sm">Update</a>
                          <a href="{{url('delete_stock', $stock->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?')">Delete</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>

                <div class="title">
                  <a href="{{url('add_stock')}}" class="btn btn-warning">Add New Stock</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <script>
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchValue = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('.table-responsive table tbody tr');
        
        rows.forEach(row => {
            const ingredientName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            row.style.display = ingredientName.includes(searchValue) ? '' : 'none';
        });
    });
</script>

    @include('admin.js')
  </body>
</html>
