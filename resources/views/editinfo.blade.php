{{view('shared.head', ['title' => 'Edit information'])}}
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
    <p class="fs-2 text-center">You are editing information about account: {{Auth::user()->email}}</p>

<form class="border p-5 col-6 mx-auto needs-validation" method="POST" action="{{route('update', Auth::user())}}">
    @csrf
    <label class="form-label" for="name">Name</label>
    <input class="form-control
    @error('name')
    is-invalid
    @enderror" id="name" name="name" type="text" value="{{Auth::user()->name}}" required><br/>

    <label class="form-label" for="surname">Surname</label>
    <input class="form-control
    @error('surname')
    is-invalid
    @enderror" id="surname" name="surname" type="text" value="{{Auth::user()->surname}}" required><br/>

    <label class="form-label" for="phone">Phone</label>
    <input class="form-control
    @error('phone')
    is-invalid
    @enderror" id="phone" name="phone" type="text" value="{{Auth::user()->phone}}" minlength="9" maxlength="9" required><br/>

    <label class="form-label" for="sex">Sex</label>
    <select class="form-select
    @error('sex')
    is-invalid
    @enderror" id="sex" name="sex">
        <option>M</option>
        <option>F</option>
    </select><br/>

    <button type="submit" class="btn btn-primary mt-3">Save!</button>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form>
</body>
