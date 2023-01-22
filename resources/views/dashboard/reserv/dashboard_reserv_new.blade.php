{{view('shared.head', ['title' => 'New reservation'])}}
<body style="overflow-x: hidden" class="container">
    @include('shared.nav')
    <p class="text-center fs-3 mt-2">Adding new trip</p>
    <form method="POST" action="{{route('adminReservsNewForm')}}" class="border p-5 col-6 mx-auto needs-validation fs-5" enctype="multipart/form-data">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @csrf
        <label for="user" class="form-label">User</label>
        <select name="user" class="form-select" id="user">
            @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->email}}</option>
            @endforeach
        </select>

        <label for="trip" class="form-label">Trip</label>
        <select name="trip" class="form-select mb-5" id="trip">
            @foreach ($trips as $trip)
                <option value="{{$trip->id}}">{{$trip->city}} {{$trip->country}} From: {{$trip->begin_date}} To: {{$trip->end_date}}</option>
            @endforeach
        </select>

        <label for="seats" class="form-label">Number of seats</label>
        <input type="number" min="1" required name="seats" class="form-control
        @error('seats') is-invalid
        @enderror" id="seats">

        <label for="price" class="form-label">Price per person</label>
        <input type="number" min="1" step="0.01" required name="price" class="form-control mb-3
        @error('price') is-invalid
        @enderror" id="price">

        <input class="btn btn-primary float-end col-4" type="submit" value="Add!">
    </form>
</body>
