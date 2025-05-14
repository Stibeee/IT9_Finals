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
          <h2>Food Promo</h2>
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>Food Title</th>
                      <th>Current Price</th>
                      <th>Promo Price</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($food as $food)
                  <tr>
                      <td>{{ $food->food_title }}</td>
                      <td>₱{{ number_format($food->price, 2) }}</td>
                      <td>
                          @if($food->is_promo)
                          <input type="number" name="promo_price" value="{{ $food->promo_price }}" class="form-control">
                          @else
                          -
                          @endif
                      </td>
                      <td>
                          @if($food->is_promo)
                          <span class="badge badge-success">Active</span>
                          @else
                          <span class="badge badge-secondary">Inactive</span>
                          @endif
                      </td>
                      <td>
                          <form action="{{ route('admin.toggle_food_promo', $food->id) }}" method="POST">
                              @csrf
                              <button type="submit" class="btn btn-sm {{ $food->is_promo ? 'btn-danger' : 'btn-success' }}">
                                  {{ $food->is_promo ? 'Deactivate' : 'Activate' }}
                              </button>
                          </form>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
      </div>
    </div>

    @include('admin.js')
  </body>
</html>
