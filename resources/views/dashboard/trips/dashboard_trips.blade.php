{{view('shared.head', ['title' => 'Work on trips'])}}
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
            <th>Id</th>
            <th>City</th>
            <th>Country</th>
            <th>Begin date</th>
            <th>End date</th>
            <th>Last minute</th>
            <th>Food option</th>
            <th>Price per person</th>
            <th></th>
        </thead>
        <tbody>
        @foreach ($trips as $trip)
            <tr>
                <td>{{$trip->id}}</td>
                <td>{{$trip->city}}</td>
                <td>{{$trip->country}}</td>
                <td>{{$trip->begin_date}}</td>
                <td>{{$trip->end_date}}</td>
                @if ($trip->last_minute == 1)
                    <td>Yes</td>
                @else
                    <td>No</td>
                @endif
                <td>{{$trip->food_option}}</td>
                <td>{{number_format($trip->price_person, 2, '.', '');}}</td>
                <td>
                    <form class="form" method="get" action="{{route('adminTripsEdit')}}">
                        <input name="trip_id" type="hidden" value="{{$trip->id}}" readonly>
                        <input class="btn btn-outline-primary" type="submit" value="Edit trip">
                    </form>
                </td>

                <td>
                    <form class="form" method="POST" action="{{route('adminTripsDelete')}}">
                        @csrf
                        <input name="trip_id" type="hidden" value="{{$trip->id}}" readonly>
                        <input class="btn btn-outline-primary" type="submit" value="Delete trip">
                    </form>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    <a class="float-end fs-3 me-4 btn btn-primary" href="{{route('adminTripsNew')}}">Add new trip</a>
</body>
