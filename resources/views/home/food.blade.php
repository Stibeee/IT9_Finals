<div id="food" class="py-5 text-center container-fluid bg-dark text-light wow fadeIn">

    @if(session('error')) 
        <div class="alert alert-danger"> 
            {{ session('error') }} 
        </div> 
    @endif

    <h2 class="py-5 section-title">Find your Best Food</h2>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="foods" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="row">

                @foreach($food as $foods)

                <div class="col-md-4">
                    <div class="my-3 bg-transparent border card my-md-0">
                        <img height="200" src="food_img/{{ $foods->image }}" class="rounded-0 card-img-top mg-responsive">

                        <div class="card-body">
                            <h1 class="mb-4 text-center">
                                <a href="#" class="badge badge-primary">₱{{ $foods->price }}</a>
                            </h1>

                            <div style="position: relative; text-align: center;" class="mb-4 pt20 pb20">
                                <h4 style="margin: 0;">{{ $foods->food_title }}</h4>
                                <div style="position: absolute; right: 0; top: 50%; transform: translateY(-50%); display: flex; align-items: center;">
                                    @if($foods->availability)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#4CAF50" height="35" viewBox="0 0 24 24" width="35" style="margin-right: 5px;">
                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                        </svg>
                                        <span style="color: #4CAF50; font-weight: bold;">Available</span>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#FF5252" height="35" viewBox="0 0 24 24" width="35" style="margin-right: 5px;">
                                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                                        </svg>
                                        <span style="color: #FF5252; font-weight: bold;">Unavailable</span>
                                    @endif
                                </div>
                            </div>

                            <p class="mb-4 text-center text-white">{{ $foods->detail }}</p>
                        </div>

                        <div style="display: flex; justify-content: center; align-items: center; margin-top: 50px;">
                            @if($foods->availability)
                                <form action="{{url ('add_cart', $foods->id) }}" method="POST" style="display: flex; gap: 10px;">
                                    @csrf
                                    <input type="hidden" name="type" value="food">
                                    <input type="number" style="width: 150px; padding: 10px; background-color: white; border: 1px solid #ccc; border-radius: 5px;" name='qty' required>
                                    <input type="submit" value="Order Now" style="width: 150px; padding: 10px; background-color: gray; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                </form>
                            @else
                                <div class="alert alert-danger" style="margin: 0; border-radius: 50px;">
                                    This food is currently unavailable.
                                </div>
                            @endif
                        </div>
                        <br><br><br>
                    </div>
                </div>

                @endforeach

            </div>
        </div>
    </div>
</div>