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


            <h1 class="text-white mb-4;">All Coffee</h1>

            <br>

            <div class="mb-4">
              <form id="searchForm">
                  <div class="input-group" style="max-width: 500px; padding: 20px;">
                      <input type="text" name="search" id="searchInput" class="form-control" 
                          placeholder="Search coffee..." value="{{ $search ?? '' }}" autocomplete="off">
                  </div>
              </form>
            </div>
            
            <div id="coffeeTable">
                <table class="table table-bordered">
                 <tr>
                    <th>Coffee Title</th>
                    <th>Coffee Details </th>
                    <th>Coffee Price </th>
                    <th>Image</th>
                    <th>Actions</th>
                    
                 </tr>


                 @foreach ($coffee as $coffees)
                 <tr>
                     <td>{{ $coffees->coffee_title }}</td>
                     <td>{{ $coffees->detail }}</td>
                     <td>₱{{ number_format($coffees->price, 2) }}</td>
                     <td>
                         <img width="150px" src="coffee_img/{{ $coffees->image }}" alt="">
                     </td>
                     <td>
                        <a class="btn btn-warning"
                        href="{{ url('update_coffee', $coffees->id) }}"> Update </a>
                         <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this file')"
                         href="{{ url('delete_coffee', $coffees->id) }}">Delete</a>

                    </td>



                    </tr>
                 @endforeach


                </table>

            </div>

      </div>
    </div>
    <script>
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchValue = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#coffeeTable table tr:not(:first-child)');
        
        rows.forEach(row => {
            const coffeeName = row.querySelector('td:first-child').textContent.toLowerCase();
            row.style.display = coffeeName.includes(searchValue) ? '' : 'none';
        });
    });
</script>
    <!-- JavaScript files-->
    @include('admin.js')

  </body>
</html>
