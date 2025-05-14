<!DOCTYPE html>
<html>
  <head>

    <base href="/public">
    @include('admin.css')


    <style>
        .div_deg{
            padding: 15px;
        }

        label{
            display: inline-block;
            width: 200px;
        }


    </style>

  </head>
  <body>
    @include('admin.header')

    @include('admin.sidebar')

      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">


            <h1>Update Coffee</h1>
            <br>

            <form action="{{ url('edit_coffee', $coffee->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="div_deg">
                    <label for="">Coffee Title</label>
                    <input type="text" name="coffee_title" value="{{ $coffee->coffee_title }}" style="color: black;">
                </div>

                <div class="div_deg">
                    <label for="details">Coffee Details</label>
                    <textarea name="detail" id="" style="color: black;">{{ $coffee->detail }}</textarea>
                </div>

                <div class="div_deg">
                    <label for="">Coffee Price</label>
                    <input type="text" name="price" value="{{ $coffee->price }}" style="color: black;">
                </div>

                <div class="div_deg">
                    <label for="">Coffee Image</label>
                    <img width="150" src="coffee_img/{{ $coffee->image }}" alt="">
                </div>

                <div class="div_deg">
                    <label for="">Change Image</label>
                    <input type="file" name="img" id="" style="color: black;">
                </div>

                <div class="div_deg">
                    <input class="btn btn-warning" type="submit" value="Update Coffee" class="btn btn-primary">
                </div>
            </form>
            </form>

      </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')

  </body>
</html>
