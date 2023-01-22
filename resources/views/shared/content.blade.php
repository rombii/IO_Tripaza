<div class="container">
    <div class="row">
    <div class="col-sm-5 col-md-4 col-lg-3 col-xl-2 bg-light px-0">
        <p class="fs-5 mt-3 mb-0 mx-auto" style="max-width: 98%">Find perfect trip for you</p>
        <hr class="mt-1">
        <form method="GET" action="{{route($route)}}"  onkeydown="return event.key != 'Enter';">
            <input class="mb-0 form-control mx-auto" type="text" name="city" placeholder="City" value="" style="max-width: 90%"/><br/>
            <input class="mb-3 form-control mx-auto" type="text" name="country" placeholder="Country" value="" style="max-width: 90%"/><br/>
            <label class="mb-2 form-label ms-2" for="start">From</label><br/>
            <input class="mb-3 form-control mx-auto
            @error('start') is-invalid
            @enderror" type="date" name="start" value="" id="start" style="max-width: 90%"/><br/>
            <label class="mb-0 form-label ms-2" for="end">To</label><br/>
            <input class="mb-3 form-control mx-auto
            @error('end') is-invalid
            @enderror" type="date" name="end" value="" id="end" style="max-width: 90%"/><br/>
            <fieldset class="mx-auto mb-3" style="max-width: 90%">
                <legend class="fs-5 fw-semibold">What type of offer?</legend>
                <hr>
                <input class="form-check-input" type="checkbox" name="type[]" id="type1" value="All Inclusive"/> <label for="type1" class="form-check-label">All Inclusive</label><br/>
                <input class="form-check-input" type="checkbox" name="type[]" id="type2" value="3 course"/>  <label for="type2" class="form-check-label">3 course</label><br/>
                <input class="form-check-input" type="checkbox" name="type[]" id="type3" value="Breakfast and Dinner"/> <label for="type3" class="form-check-label">Breakfast and Dinner</label><br/>
                <input class="form-check-input" type="checkbox" name="type[]" id="type4" value="Breakfast"/> <label for="type4" class="form-check-label">Breakfast</label><br/>
                <input class="form-check-input" type="checkbox" name="type[]" id="type5" value="Without food"/> <label for="type5" class="form-check-label">Without food</label><br/>
            </fieldset>
            <input class="btn btn-primary float-end me-2 mt-3" type="submit" value="Filter!" style="width: 90px;"/>
        </form>
        @if ($errors->any())
        <div class="alert alert-danger float-start mx-2 my-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
<div class="col-sm-7 col-md-8 col-lg-9 col-xl-10 px-0">
    @forelse ($trips as $trip)
        <div class="card mb-3 bg-light" style="border: 0">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="{{asset('storage/img/trip'.$trip->id.'.jpg')}}" class="img-fluid rounded-start" alt="...">
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
                                <input name="trip_id" type="hidden" value="{{$trip->id}}" style="display: none" readonly>
                                <input class="btn fs-1 float-end
                                @if($trip->begin_date > Carbon::now()->addMonths(6) || $trip->begin_date < Carbon::now()->addDays(5))
                                    mt-4
                                @endif
                                " type="submit" value="❤️" />

                            </form>
                        @else
                            <form method="POST" action="{{route('addTF')}}">
                                @csrf
                                <input name="trip_id" type="hidden" value="{{$trip->id}}" style="display: none" readonly>
                                <input class="btn fs-1 float-end
                                @if($trip->begin_date > Carbon::now()->addMonths(6) || $trip->begin_date < Carbon::now()->addDays(5))
                                    mt-4
                                @endif
                                " type="submit" value="🤍" />

                            </form>
                        @endif
                    @endif
                </div>
                @if ($trip->calcPrice($trip->id) != $trip->price_person)
                    <p class="text-end fs-5 me-5 text-decoration-line-through mb-0">
                        {{$trip->price_person}}
                    </p>
                    <p class="text-end fs-2 me-5 fw-bolder text-danger">
                        {{$trip->calcPrice($trip->id)}}
                    </p>
                @else
                    <p class="text-end fs-3 me-5">
                        {{$trip->price_person}}
                    </p>
                @endif
                @if(Auth::check())
                    @if($trip->reservationExists())
                    <form method="get" action="{{route('editTrip')}}">
                        @csrf
                        <input name="trip_id" type="hidden" value ="{{$trip->id}}"/>
                        <input class="float-end fs-2 me-4 mb-2 btn btn-outline-primary" type="submit" value="Edit reservation!"/>
                    </form>
                    @else
                    <form method="get" action="{{route('bookTrip')}}">
                        <input name="trip_id" type="hidden" value ="{{$trip->id}}"/>
                        <input class="float-end fs-2 me-4 mb-2 btn btn-outline-primary" type="submit" value="Book now!"/>
                    </form>
                    @endif
                @else
                    <a class="float-end fs-2 me-4 mb-2 btn btn-outline-primary" href="{{route('login')}}" >Book now!</a>
                @endif
              </div>
            </div>
          </div>
    @empty
          <h4 class="text-center mt-5">Sorry we don't have trips that match your criteria.</h4>
    @endforelse
</div>
</div>
</div>
<div class="d-flex justify-content-center">
    @if (True)

    {!! $trips->links() !!}
    @endif
</div>
