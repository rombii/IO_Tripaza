{{view('shared.head', ['title' => 'Booking'])}}
<body style="overflow-x: hidden" class="container">
    @include('shared.nav')

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card mb-3 bg-light" style="border: 0">
        <div class="row g-0">
          <div class="col-md-6">
            <img src="{{asset('storage/img/trip'.$trip->id.'.jpg')}}" class="img-fluid rounded-start" alt="destination picture">
          </div>
          <div class="col-md-6">
            <div class="card-body">
              <h5 class="card-title">{{$trip->city}}</h5>
              <h6 class="card-title">{{$trip->country}}</h6>
              <p class="card-text mb-0">From: {{$trip->begin_date}}</p>
              <p class="card-text mb-0">To: {{$trip->end_date}}</p>
              @if($trip->last_minute == 1)
              <p class="card-text mb-0">Last minute</p>
              @endif
              <p class="card-text mb-5">Food option: {{$trip->food_option}}</p>
            </div>
            @if(Auth::user()->name == "")
                @if ($trip->calcPrice($trip->id) != $trip->price_person)
                    <p class="text-end fs-5 me-5 text-decoration-line-through mb-0 mt-5">
                        {{$trip->price_person}}
                    </p>
                    <p class="text-end fs-2 me-5 fw-bolder text-danger"  id="total">
                        {{$trip->calcPrice($trip->id)}}
                    </p>
                @else
                    <p class="text-end fs-3 me-5 mt-5"  id="total">
                        {{$trip->price_person}}
                    </p>
                @endif
                <p class="float-end me-5 fs-4">You need to fill your data <a href="{{route('edit')}}">here</a></p>
            @else
                @if(Request::is('booking/new'))
                    @if ($trip->calcPrice($trip->id) != $trip->price_person)
                        <p class="text-end fs-5 me-5 text-decoration-line-through mb-0 mt-5">
                            {{$trip->price_person}}
                        </p>
                        <p class="text-end fs-2 me-5 fw-bolder text-danger"  id="total">
                            {{$trip->calcPrice($trip->id)}}
                        </p>
                    @else
                        <p class="text-end fs-3 me-5 mt-5"  id="total">
                            {{$trip->price_person}}
                        </p>
                    @endif
                    <form method="post" action="{{route('book')}}" class="float-end" onkeydown="return event.key != 'Enter';">
                        @csrf
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}" readonly>
                        <input type="hidden" name="trip_id" value="{{$trip->id}}" readonly>
                        <label class="text-end" for="seats">How much seats?</label>
                        <input class="me-5
                        @error('seats')
                        is-invalid
                        @enderror" id="seats" name="seats" type="number" onchange="document.getElementById('total').innerText = ({{$trip->calcPrice($trip->id)}}*document.getElementById('seats').value).toFixed(2)" min="1" max="{{$trip->participants_number_left}}"><br/>
                        <input class="float-end fs-3 me-5 mb-2 mt-3 btn btn-primary" type="submit" value="Book!"/>
                    </form>
                @else
                    @if($trip->getPrice() < $trip->price_person)
                        <p class="text-end fs-2 me-5 fw-bolder text-danger" id="total">
                            {{number_format($trip->getPrice() * $trip->getSeats(), 2, '.', '')}}
                        </p>
                    @else
                        <p class="text-end fs-3 me-5 mt-5" id="total">
                            {{number_format($trip->getPrice() * $trip->getSeats(), 2, '.', '')}}
                        </p>
                    @endif
                    <form method="post" action="{{route('updateTrip')}}" class="float-end" onkeydown="return event.key != 'Enter';">
                        @csrf
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="trip_id" value="{{$trip->id}}">
                        <label class="text-end ms-5" for="seats">How much seats?</label>
                        <input class="me-5
                        @error('city') is-invalid
                        @enderror" id="seats" name="seats" type="number" onchange="document.getElementById('total').innerText = ({{$trip->getPrice()}}*document.getElementById('seats').value).toFixed(2)" min="1" max="{{$trip->participants_number_left + $trip->getSeats()}}" value="{{$trip->getSeats()}}"><br/>
                        <input class="float-end fs-3 me-5 mb-2 mt-3 btn btn-primary" type="submit" value="Edit reservation!"/>
                    </form>
                @endif
            @endif
          </div>
        </div>
      </div>
</body>
