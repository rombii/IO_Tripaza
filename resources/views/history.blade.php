{{view('shared.head', ['title' => 'History of reservations'])}}
<body style="overflow-x: hidden" class="container">
    @include('shared.nav')
    @if($reservations->isEmpty())
    <div class="grid mt-5" style="height: 200px">
        <div class="row text-center">
            <h3>You dont have any reservations...</h3><br>
        </div>
        <div class="row text-center">
            <h2>Choose one <a href="{{route('all')}}">here</a>!</h2>
        </div>
</div>
    @else
        <table class="table">
            <thead>
                <th>City</th>
                <th>Country</th>
                <th>Begin date</th>
                <th>End date</th>
                <th>Last minute</th>
                <th>Food option</th>
                <th>Number of seats</th>
                <th>Total price</th>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{$reservation->findTrip()->city}}</td>
                        <td>{{$reservation->findTrip()->country}}</td>
                        <td>{{$reservation->findTrip()->begin_date}}</td>
                        <td>{{$reservation->findTrip()->end_date}}</td>
                        @if ($reservation->findTrip()->last_minute == 1)
                            <td>Yes</td>
                        @else
                            <td>No</td>
                        @endif
                        <td>{{$reservation->findTrip()->food_option}}</td>
                        <td>{{$reservation->number_of_seats}}</td>
                        <td>{{number_format($reservation->price_person * $reservation->number_of_seats, 2, '.', '');}}</td>
                        @if($reservation->findTrip()->begin_date > Carbon::now()->addDays(3))
                        <td>
                            <form method="post" action="{{route('remRes')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$reservation->id}}">
                                <input type="hidden" name="trip_id" value="{{$reservation->trip_id}}">
                                <input class="btn btn-outline-dark" type="submit" value="Cancel reservation">
                            </form>
                        </td>
                        <td>
                            <form method="post" action="{{route('editTrip')}}">
                                @csrf
                                <input type="hidden" name="trip_id" value="{{$reservation->trip_id}}">
                                <input class="btn btn-outline-dark" type="submit" value="Edit reservation">
                            </form>
                        </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            <p class="text-center fs-5">Remember all info about payment should be sent to your e-mail after booking!<br/> Always check Spam folder <br/> If you think our mail didn't get to its destination write to our support <a href="{{route('support')}}">here</a></p>
        @endif
</body>

