<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')

    <style>
      
      h1 {
        margin-bottom: 100px;
      }
      
      .container-fluid {
     
        place-items: center;
        background-color: #2d3035;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
      }

      input[type="text"],
      input[type="number"],
      input[type="textarea"] {
        width: 300px;
        padding: 8px;
        border: 1px solid #444;
        border-radius: 4px;
        background-color: #363940;
        color: white;
      }
      
      textarea{
      width: 300px;
        padding: 8px;
        border: 1px solid #444;
        border-radius: 4px;
        background-color: #363940;
        color: white;
      }
      
      label {
        display: inline-block;
        width: 200px;
        color: white;
        margin-bottom: 5px;
      }

      .div_deg {
        padding: 10px;
        margin-bottom: 20px;
      }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
      <div class="page-header">
        
        <div class="container-fluid">
          <h1 class="text-white mb-4;">Add New Coffee</h1>
          
          <form action="{{ ('upload_coffee') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="div_deg">
              <label for="">Coffee Title</label>
              <input type="text" name="coffee_title" placeholder="Coffee Title" required>
            </div>

            <div class="div_deg">
              <label for="">Coffee Details</label>
              <textarea name="detail" cols="50" rows="5" placeholder="Coffee Details" required></textarea>
            </div>

            <div class="div_deg">
              <label for="">Coffee Price</label>
              <input type="text" name="price" placeholder="Coffee Price" required>
            </div>

            <div class="div_deg">
              <label for="">Image</label>
              <input type="file" name="img" required>
            </div>

            <div class="div_deg">
              <input type="submit" value="Add Coffee" class="btn btn-warning">
            </div>
          </form>
        </div>
      </div>
    </div>

    @include('admin.js')
  </body>
</html>
