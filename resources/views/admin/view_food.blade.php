<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')
    <style>
        table{
            border: 1px solid white;
            margin: auto;
            margin-top: 20px;
            width: 800%;
            text-align: center;
            width: 100%;
            border-collapse: collapse;

        }

        th
        {
            background: #DCDCDC;
            color: black;
            padding: 10px;
            margin: 10px;
        }

        td
        {

            color: white;
            padding: 10px;
            margin: 10px;
        }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid">
          <h1 class="text-white mb-4;">All Food</h1>
          <br>
          <div class="mb-4">
            <form id="searchForm">
                <div class="input-group" style="max-width: 500px; padding: 20px;">
                    <input type="text" name="search" id="searchInput" class="form-control" 
                        placeholder="Search food..." value="{{ $search ?? '' }}" 
                        autocomplete="off">
                </div>
            </form>
          </div>

<div id="foodTable">
    <table class="table table-bordered">
            <thead>
              <tr>
                <th>Food Title</th>
                <th>Details</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($food as $food)
              <tr>
                <td>{{ $food->food_title }}</td>
                <td>{{ $food->detail }}</td>
                <td>₱{{ number_format($food->price, 2) }}</td>
                <td><img width="125px" src="food_img/{{ $food->image }}" alt="Food Image">
                <td>
                  <a href="{{ route('admin.update_food', $food->id) }}" class="btn btn-warning">Update</a>
                  <a href="{{ route('admin.delete_food', $food->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
        <script>
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchValue = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#foodTable table tbody tr');
        
        rows.forEach(row => {
            const foodName = row.querySelector('td:first-child').textContent.toLowerCase();
            row.style.display = foodName.includes(searchValue) ? '' : 'none';
        });
    });
</script>
    @include('admin.js')
  </body>
</html>
