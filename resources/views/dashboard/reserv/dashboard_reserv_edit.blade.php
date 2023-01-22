{{view('shared.head', ['title' => 'Edit reservation'])}}
<body style="overflow-x: hidden" class="container">
    @include('shared.nav')
    <p class="text-center fs-3 mt-2">Adding new trip</p>
    <form method="POST" action="{{route('adminReservsEditForm')}}" class="border p-5 col-6 mx-auto needs-validation fs-5" enctype="multipart/form-data">
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
        <input type="hidden" value="{{$reservation->id}}" name="id">
        <label for="user" class="form-label">User</label>
        <input type="text" required name="user" class="form-control" id="user" value="{{$user->email}}" readonly>

        <label for="trip" class="form-label">Trip</label>
        <input type="text" required name="user" class="form-control" id="user" value="{{$trip->city}} {{$trip->country}} From: {{$trip->begin_date}} To: {{$trip->end_date}}" readonly>

        <label for="seats" class="form-label">Number of seats</label>
        <input type="number" min="1" required name="seats" class="form-control
        @error('seats') is-invalid
        @enderror" id="seats" value="{{$reservation->number_of_seats}}">

        <label for="price" class="form-label">Price per person</label>
        <input type="number" min="1" step="0.01" required name="price" class="form-control mb-3
        @error('price') is-invalid
        @enderror" id="price" value="{{$reservation->price_person}}">

        <input class="btn btn-primary float-end col-4" type="submit" value="Edit!">
    </form>
</body>
