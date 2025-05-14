<!DOCTYPE html>
<html>
  <head>
    <base href="/public">
    @include('admin.css')

    <style>
      label {
        display: inline-block;
        width: 200px;
        color: white;
      }

      .div_deg {
        padding: 10px;
      }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid">
          <form action="{{ route('admin.edit_food', $food->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="div_deg">
              <label for="">Food Title</label>
              <input type="text" name="food_title" value="{{ $food->food_title }}" placeholder="Food Title" required>
            </div>

            <div class="div_deg">
              <label for="">Food Details</label>
              <textarea name="detail" cols="50" rows="5" placeholder="Food Details" required>{{ $food->detail }}</textarea>
            </div>

            <div class="div_deg">
              <label for="">Food Price</label>
              <input type="text" name="price" value="{{ $food->price }}" placeholder="Food Price" required>
            </div>

            <div class="div_deg">
              <label for="">Image</label>
              <input type="file" name="img">
              <img src="{{ asset('storage/' . $food->img) }}" alt="food image" width="100">
            </div>

            <div class="div_deg">
              <input type="submit" value="Update Food" class="btn btn-warning">
            </div>
          </form>
        </div>
      </div>
    </div>

    @include('admin.js')
  </body>
</html>
