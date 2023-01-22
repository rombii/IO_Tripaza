{{view('shared.head', ['title' => 'Favourites'])}}
<body style="overflow-x: hidden" class="container">
    @include('shared.nav')
    <div>
        @forelse ($trips as $trip)

            <div class="card mb-3 bg-light" style="border: 0">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="{{asset('storage/img/trip'.$trip->id.'.jpg')}}" class="img-fluid " alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">{{$trip->city}}</h5>
                      <h6 class="card-title">{{$trip->country}}</h6>
                      <p class="card-text mb-0">From: {{$trip->begin_date}}</p>
                      <p class="card-text mb-0">To: {{$trip->end_date}}</p>
                      @if($trip->last_minute == 1)
                      <p class="card-text mb-0">Last minute</p>
                      @endif
                      <p class="card-text mb-0">Food option: {{$trip->food_option}}</p>
                      <p class="card-text mb-0"><small class="text-muted">
                        @if($trip->participants_number_left <= 5)
                            Only
                        @endif
                        {{$trip->participants_number_left}} available spots left</small></p>
                        @if(Auth::check())
                            @if ($trip->favouriteExists())
                                <form method="POST" action="{{route('remTF')}}">
                                    @csrf
                                    <input name="trip_id" type="hidden" value="{{$trip->id}}" style="display: none">
                                    <input class="btn fs-1 float-end" type="submit" value="❤️" />

                                </form>
                            @else
                                <form method="POST" action="{{route('addTF')}}">
                                    @csrf
                                    <input name="trip_id" type="hidden" value="{{$trip->id}}" style="display: none">
                                    <input class="btn fs-1 float-end" type="submit" value="🤍" />

                                </form>
                            @endif
                        @endif
                    </div>
                    <p class="text-end fs-3 me-5">{{$trip->price_person}}</p>
                    <button class="float-end fs-2 me-4 mb-2 btn btn-outline-primary">Book now!</button>
                  </div>
                </div>
              </div>
        @empty
        <div class="grid mt-5" style="height: 200px">
                <div class="row text-center">
                    <h3>You dont have any trips in your favourites...</h3><br>
                </div>
                <div class="row text-center">
                    <h2>Choose one <a href="{{route('all')}}">here</a>!</h2>
                </div>
        </div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center">
        @if (True)

        {!! $trips->links() !!}
        @endif
    </div>

</body>
