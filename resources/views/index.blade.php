{{view('shared.head', ['title' => 'Welcome!'])}}
<body style="overflow-x: hidden" class="container">
    @include('shared.nav')
    <div class="grid col-12">
        <div class="row col-12">
            <div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-4 float-start mt-3">
                <p class="text-center fs-3 bg-white mt-3 text-primary rounded fw-bold">Newest trips!</p>
            @foreach ($newest as $new)
            <div class="card mb-3">
                <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{asset('storage/img/trip'.$new->id.'.jpg')}}" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                    <h5 class="card-title">{{$new->city}}</h5>
                    <h6 class="card-title">{{$new->country}}</h6>
                    <p class="card-text mb-0">From: {{$new->begin_date}}</p>
                    <p class="card-text mb-0">To: {{$new->end_date}}</p>
                    @if($new->last_minute == 1)
                        <p class="card-text mb-0">Last minute</p>
                    @endif
                        <p class="card-text mb-0">Food option: {{$new->food_option}}</p>
                    </div>
                    @if(Auth::check())
                            @if($new->reservationExists())
                            <form method="post" action="{{route('editTrip')}}">
                                @csrf
                                <input name="trip_id" type="hidden" value ="{{$new->id}}"/>
                                <input class="float-end fs-5 me-4 mb-2 btn btn-outline-primary" type="submit" value="Edit reservation!"/>
                            </form>
                            @else
                            <form method="post" action="{{route('bookTrip')}}">
                                @csrf
                                <input name="trip_id" type="hidden" value ="{{$new->id}}"/>
                                <input class="float-end fs-5 me-4 mb-2 btn btn-outline-primary" type="submit" value="Book now!"/>
                            </form>
                            @endif
                    @endif
                </div>
                </div>
            </div>

            @endforeach
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-8 float-start mt-3">
                <p class="text-center fs-3 bg-white mt-3 text-primary rounded fw-bold">Deal of the day!</p>

                <div class="card mb-3" style="">
                    <div class="row g-0">
                      <div class="col-md-6">
                        <img src="{{asset('storage/img/trip'.$deal->id.'.jpg')}}" class="img-fluid rounded-start">
                      </div>
                      <div class="col-md-6">
                        <div class="card-body">
                                <h5 class="card-title">{{$deal->city}}</h5>
                                <h6 class="card-title">{{$deal->country}}</h6>
                                <p class="card-text mb-0">From: {{$deal->begin_date}}</p>
                                <p class="card-text mb-0">To: {{$deal->end_date}}</p>
                                @if($deal->last_minute == 1)
                                    <p class="card-text mb-0">Last minute</p>
                                @endif
                                    <p class="card-text mb-0">Food option: {{$deal->food_option}}</p>
                                </div>
                                <p class="text-end fs-5 me-5 text-decoration-line-through mb-0 mt-5">
                                    {{$deal->price_person}}
                                </p>
                                <p class="text-end fs-2 me-5 fw-bolder text-danger"  id="total">
                                    {{$deal->calcPrice($deal->id)}}
                                </p>
                                <div class="mb-0">
                                @if(Auth::check())
                                        @if($deal->reservationExists())
                                        <form method="post" action="{{route('editTrip')}}" class="fixed-bottom">
                                            @csrf
                                            <input name="trip_id" type="hidden" value ="{{$deal->id}}"/>
                                            <input class="float-end fs-5 me-4 mb-2 btn btn-outline-primary" type="submit" value="Edit reservation!"/>
                                        </form>
                                        @else
                                        <form method="post" action="{{route('bookTrip')}}" style="position: relative; margin-top: 180px;">
                                            @csrf
                                            <input name="trip_id" type="hidden" value="{{$deal->id}}"/>
                                            <input type="hidden" name="deal" value=1>
                                            <input class="float-end fs-5 me-4 mb-2 btn btn-outline-primary" type="submit" value="Book now!"/>
                                        </form>
                                        @endif
                                    @endif
                                </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 float-start">
            <p class="text-center fs-3 bg-white mt-3 text-primary rounded fw-bold">Most booked!</p>
        @foreach ($booked as $new)
        <div class="card mb-3">
            <div class="row g-0">
            <div class="col-md-4">
                <img src="{{asset('storage/img/trip'.$new->id.'.jpg')}}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                <h5 class="card-title">{{$new->city}}</h5>
                <h6 class="card-title">{{$new->country}}</h6>
                <p class="card-text mb-0">From: {{$new->begin_date}}</p>
                <p class="card-text mb-0">To: {{$new->end_date}}</p>
                @if($new->last_minute == 1)
                    <p class="card-text mb-0">Last minute</p>
                @endif
                    <p class="card-text mb-0">Food option: {{$new->food_option}}</p>
                </div>
                @if(Auth::check())
                        @if($new->reservationExists())
                        <form method="post" action="{{route('editTrip')}}">
                            @csrf
                            <input name="trip_id" type="hidden" value ="{{$new->id}}"/>
                            <input class="float-end fs-5 me-4 mb-2 btn btn-outline-primary" type="submit" value="Edit reservation!"/>
                        </form>
                        @else
                        <form method="post" action="{{route('bookTrip')}}">
                            @csrf
                            <input name="trip_id" type="hidden" value ="{{$new->id}}"/>
                            <input class="float-end fs-5 me-4 mb-2 btn btn-outline-primary" type="submit" value="Book now!"/>
                        </form>
                        @endif
                    @endif
            </div>
            </div>
        </div>

        @endforeach
        </div>


        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 float-start">
            <p class="text-center fs-3 bg-white mt-3 text-primary rounded fw-bold">Most favourited!</p>
        @foreach ($favourite as $new)
        <div class="card mb-3">
            <div class="row g-0">
            <div class="col-md-4">
                <img src="{{asset('storage/img/trip'.$new->id.'.jpg')}}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                <h5 class="card-title">{{$new->city}}</h5>
                <h6 class="card-title">{{$new->country}}</h6>
                <p class="card-text mb-0">From: {{$new->begin_date}}</p>
                <p class="card-text mb-0">To: {{$new->end_date}}</p>
                @if($new->last_minute == 1)
                    <p class="card-text mb-0">Last minute</p>
                @endif
                    <p class="card-text mb-0">Food option: {{$new->food_option}}</p>
                </div>
                @if(Auth::check())
                        @if($new->reservationExists())
                        <form method="post" action="{{route('editTrip')}}">
                            @csrf
                            <input name="trip_id" type="hidden" value ="{{$new->id}}"/>
                            <input class="float-end fs-5 me-4 mb-2 btn btn-outline-primary" type="submit" value="Edit reservation!"/>
                        </form>
                        @else
                        <form method="post" action="{{route('bookTrip')}}">
                            @csrf
                            <input name="trip_id" type="hidden" value ="{{$new->id}}"/>
                            <input class="float-end fs-5 me-4 mb-2 btn btn-outline-primary" type="submit" value="Book now!"/>
                        </form>
                        @endif
                    @endif
            </div>
            </div>
        </div>

        @endforeach
        </div>
    </div>
</body>


