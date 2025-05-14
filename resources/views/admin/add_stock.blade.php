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
      
      .form-group {
        margin-bottom: 20px;
      }
      
      label {
        display: inline-block;
        width: 200px;
        color: white;
        margin-bottom: 5px;
      }
      
      input[type="text"],
      input[type="number"] {
        width: 300px;
        padding: 8px;
        border: 1px solid #444;
        border-radius: 4px;
        background-color: #363940;
        color: white;
      }
      
      select {
        width: 300px;
        padding: 8px;
        border: 1px solid #444;
        border-radius: 4px;
        background-color: #363940;
        color: white;
      }
      
      .btn-warning {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
      }
      
      .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
      }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid">
          <h1 class="text-white mb-4;">Add New Stock</h1>
          <form action="{{ route('admin.store_stock') }}" method="POST">
            @csrf

            <div class="form-group">
              <label for="ingredient_name">Ingredient Name</label>
              <input type="text" id="ingredient_name" name="ingredient_name" placeholder="Enter ingredient name" required>
            </div>

            <div class="form-group">
              <label for="quantity">Quantity</label>
              <input type="number" id="quantity" name="quantity" min="0" step="0.01" placeholder="Enter quantity" required>
            </div>

            <div class="form-group">
              <label for="unit">Unit</label>
              <select id="unit" name="unit" required>
                <option value="">Select unit</option>
                <option value="g">Grams (g)</option>
                <option value="kg">Kilograms (kg)</option>
                <option value="ml">Milliliters (ml)</option>
                <option value="L">Liters (L)</option>
                <option value="pcs">Pieces (pcs)</option>
              </select>
            </div>

            <div class="form-group">
              <label for="minimum_stock">Minimum Stock Level</label>
              <input type="number" id="minimum_stock" name="minimum_stock" min="0" step="0.01" placeholder="Enter minimum stock level" required>
            </div>

            <div class="form-group">
              <input type="submit" value="Add Stock" class="btn btn-warning">
            </div>
          </form>
        </div>
      </div>
    </div>

    @include('admin.js')
  </body>
</html>