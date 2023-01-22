{{view('shared.head', ['title' => 'Adding trip'])}}
<body style="overflow-x: hidden" class="container">
    @include('shared.nav')
    <p class="text-center fs-3 mt-2">Adding new trip</p>
    <form method="POST" action="{{route('adminTripsNewForm')}}" class="border p-5 col-6 mx-auto needs-validation fs-5" enctype="multipart/form-data">
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
        <label class="form-label" for="country">Country</label>
        <input required class="mb-0 form-control
        @error('country') is-invalid

        @enderror" type="text" name="country" id="country"><br>


        <label class="form-label" for="city">City</label>
        <input required class="mb-0 form-control
        @error('city') is-invalid

        @enderror" type="text" name="city" id="city"><br>


        <label class="form-label" for="bdate">Begin</label>
        <input required class="mb-0 form-control
        @error('begin_date') is-invalid

        @enderror" type="date" name="begin_date" id="bdate"><br>


        <label class="form-label" for="edate">End</label>
        <input required class="mb-0 form-control
        @error('end_date') is-invalid

        @enderror" type="date" name="end_date" id="edate"><br>


        <label class="form-label" for="price">Price per person</label>
        <input required class="mb-0 form-control
        @error('price') is-invalid

        @enderror" type="number" min="1" step="0.01" name="price" id="price"><br>


        <label class="form-label" for="tyoe">Type</label>
        <select name="type" class="mb-0 form-select
        @error('type') is-invalid

        @enderror" id="type">
            <option>All inclusive</option>
            <option>3 course</option>
            <option>Breakfast and dinner</option>
            <option>Breakfast</option>
            <option>Without food</option>
        </select><br>

        <label class="form-label" for="seats">Seats</label>
        <input required class="mb-0 form-control
        @error('seats') is-invalid

        @enderror" type="number" min="1" name="seats" id="seats"><br>


        <label class="form-check-label" for="lm">Last minute</label>
        <input class="mb-3 form-check-input
        @error('last_minute') is-invalid
        @enderror" type="checkbox" name="last_minute" id="lm"><br>

        <input required type="file" name="photo" accept=".jpg, .jpeg, .png">

        <input class="btn btn-primary float-end col-4" type="submit" value="Add!">
    </form>
</body>
