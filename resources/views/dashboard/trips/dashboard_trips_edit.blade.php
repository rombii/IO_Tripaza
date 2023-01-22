{{view('shared.head', ['title' => 'Edit trip'])}}
<body style="overflow-x: hidden" class="container">
    @include('shared.nav')
    <p class="text-center fs-3 mt-2">Editing trip</p>
    <form method="POST" action="{{route('adminTripsEditForm')}}" class="border p-5 col-6 mx-auto needs-validation fs-5" enctype="multipart/form-data">
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
        <input type="hidden" value="{{$trip->id}}" name="trip_id">
        <label class="form-label" for="country">Country</label>
        <input required class="mb-0 form-control
        @error('country') is-invalid

        @enderror" type="text" name="country" id="country" value="{{$trip->country}}"><br>


        <label class="form-label" for="city">City</label>
        <input required class="mb-0 form-control
        @error('city') is-invalid

        @enderror" type="text" name="city" id="city" value="{{$trip->city}}"><br>


        <label class="form-label" for="bdate">Begin</label>
        <input required class="mb-0 form-control
        @error('begin_date') is-invalid

        @enderror" type="date" name="begin_date" id="bdate" value="{{$trip->begin_date}}"><br>


        <label class="form-label" for="edate">End</label>
        <input required class="mb-0 form-control
        @error('end_date') is-invalid

        @enderror" type="date" name="end_date" id="edate" value="{{$trip->end_date}}"><br>


        <label class="form-label" for="price">Price per person</label>
        <input required class="mb-0 form-control
        @error('price') is-invalid

        @enderror" type="number" min="1" step="0.01" name="price" id="price" value="{{$trip->price_person}}"><br>

        <label class="form-label" for="tyoe">Type</label>
        <select name="type" class="mb-0 form-select
        @error('type') is-invalid
        @enderror" id="type">
            <option
            @if($trip->food_option == 'All Inclusive')
                selected
            @endif>All inclusive</option>
            <option
            @if($trip->food_option == '3 course')
                selected
            @endif>3 course</option>
            <option
            @if($trip->food_option == 'Breakfast and Dinner')
                selected
            @endif>Breakfast and Dinner</option>
            <option
            @if($trip->food_option == 'Breakfast')
                selected
            @endif>Breakfast</option>
            <option
            @if($trip->food_option == 'Without food')
                selected
            @endif>Without food</option>
        </select><br>

        <label class="form-label" for="seats">Seats</label>
        <input required class="mb-0 form-control
        @error('seats') is-invalid

        @enderror" type="number" min="1" name="seats" id="seats" value="{{$trip->participants_number_left}}"><br>


        <label class="form-check-label" for="lm">Last minute</label>
        <input class="mb-3 form-check-input
        @error('last_minute') is-invalid
        @enderror" type="checkbox" name="last_minute" id="lm"
        @if($trip->last_minute == 1)
            checked
        @endif><br>
        <label class="form label mb-2" for="photo">If you want to change actual photo of trip add it here</label>
        <input class="form-control" type="file" name="photo" accept=".jpg, .jpeg, .png" id="photo">

        <input class="btn btn-primary float-end col-4" type="submit" value="Edit!">
    </form>
</body>
