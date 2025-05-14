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
          <h1 class="text-white mb-4;">Stock History</h1>
        </div>
      </div>
      
      <section class="no-padding-top">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="block">
                <div class="title">
                  <strong class="d-block">Stock Movement History</strong>
                  <span class="d-block">Track all ingredient movements</span>
                </div>

                <div class="table-responsive">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Ingredient</th>
                        <th>Type</th>
                        <th>Previous Qty</th>
                        <th>Change</th>
                        <th>New Qty</th>
                            
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($history as $history)
                      <tr>
                        <td>{{$history->created_at->format('Y-m-d H:i')}}</td>
                        <td>{{$history->stock->ingredient_name}}</td>
                        <td>
                          @if($history->type == 'in')
                            <span class="badge badge-success">Added</span>
                          @else
                            <span class="badge badge-warning">Updated</span>
                          @endif
                        </td>
                        <td>{{$history->previous_quantity}} {{$history->stock->unit}}</td>
                        <td>
                          @if($history->type == 'in')
                            <span class="text-success">+{{$history->quantity}}</span>
                          @else
                            <span class="text-warning">-{{$history->quantity}}</span>
                          @endif
                        </td>
                        <td>{{$history->new_quantity}} {{$history->stock->unit}}</td>
                        
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    @include('admin.js')
  </body>
</html>