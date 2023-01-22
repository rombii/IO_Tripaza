{{view('shared.head', ['title' => 'All reservations'])}}
<body style="overflow-x: hidden" class="container">
    @include('shared.nav')
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif

    @if (\Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('error') !!}</li>
        </ul>
    </div>
    @endif
    <table class="table">
        <thead>
            <th>ID</th>
            <th>User id</th>
            <th>Trip id</th>
            <th>Number of seats</th>
            <th>Price per person</th>
        </thead>
        <tbody>
        @foreach ($reservations as $reservation)
            <tr>
                <td>{{$reservation->id}}</td>
                <td>{{$reservation->user_id}}</td>
                <td>{{$reservation->trip_id}}</td>
                <td>{{$reservation->number_of_seats}}</td>
                <td>{{$reservation->price_person}}</td>
                <td>
                    <form class="form" method="get" action="{{route('adminReservsEdit')}}">
                        <input type="hidden" name="id" value="{{$reservation->id}}" readonly>
                        <input class="btn btn-outline-primary" type="submit" value="Edit trip">
                    </form>
                </td>

                <td>
                    <form class="form" method="POST" action="{{route('adminReservsDelete')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$reservation->id}}" readonly>
                        <input class="btn btn-outline-primary" type="submit" value="Delete trip">
                    </form>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    <a class="float-end fs-3 me-4 btn btn-primary" href="{{route('adminReservsNew')}}">Add new reservation</a>
</body>
