<!DOCTYPE html>
<html>
  <head>
    <base href="/public">
    @include('admin.css')
    <style>
      .div_deg {
        padding: 15px;
      }
      label {
        display: inline-block;
        width: 200px;
        color: white;
      }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid">
          <h1>Update Stock</h1>
          <br>

          <form action="{{ route('admin.edit_stock', $stock->id) }}" method="POST">
            @csrf
            <div class="div_deg">
              <label>Ingredient Name</label>
              <input type="text" name="ingredient_name" value="{{ $stock->ingredient_name }}" required style="color: black;">
            </div>

            <div class="div_deg">
              <label>Quantity</label>
              <input type="number" name="quantity" value="{{ $stock->quantity }}" required style="color: black;">
            </div>

            <div class="div_deg">
              <label for="unit">Unit</label>
              <select id="unit" name="unit" required>
                <option value="g" {{ $stock->unit == 'g' ? 'selected' : '' }}>Grams (g)</option>
                <option value="kg" {{ $stock->unit == 'kg' ? 'selected' : '' }}>Kilograms (kg)</option>
                <option value="ml" {{ $stock->unit == 'ml' ? 'selected' : '' }}>Milliliters (ml)</option>
                <option value="L" {{ $stock->unit == 'L' ? 'selected' : '' }}>Liters (L)</option>
                <option value="pcs" {{ $stock->unit == 'pcs' ? 'selected' : '' }}>Pieces (pcs)</option>
                <option value="pack" {{ $stock->unit == 'pack' ? 'selected' : '' }}>Pack</option>
              </select>
            </div>

            <div class="div_deg">
              <label>Minimum Stock Level</label>
              <input type="number" name="minimum_stock" value="{{ $stock->minimum_stock }}" required style="color: black;">
            </div>

            <div class="div_deg">
              <input type="submit" value="Update Stock" class="btn btn-warning">
            </div>
          </form>
        </div>
      </div>
    </div>

    @include('admin.js')
  </body>
</html>