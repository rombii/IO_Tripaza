{{view('shared.head', ['title' => 'Edit user'])}}
<body style="overflow-x: hidden" class="container">
    @include('shared.nav')
    <p class="text-center fs-3 mt-2">Edit user with id {{$user->id}}</p>
    <form method="POST" action="{{route('adminUsersEditForm')}}" class="border p-5 col-6 mx-auto needs-validation fs-5" enctype="multipart/form-data">
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
        <input type="hidden" value="{{$user->id}}" name="id">
        <label for="email" class="form-label">User</label>
        <input type="text" required name="email" class="form-control" id="email" value="{{$user->email}}">

        <label for="name" class="form-label">Name</label>
        <input type="text" required name="name" class="form-control" id="name" value="{{$user->name}}">

        <label for="surname" class="form-label">Surname</label>
        <input type="text" required name="surname" class="form-control" id="surname" value="{{$user->surname}}">

        <label for="phone" class="form-label">Phone</label>
        <input type="text" inputmode="numeric" pattern="\d*" required name="phone" class="form-control mb-3" id="phone" value="{{$user->phone}}">

        <div class="btn-group" role="group" aria-label="sex radio group">
            <input type="radio" class="btn-check" name="sex" id="m" autocomplete="off" value="m">
            <label class="btn btn-outline-primary" for="m">Male</label>

            <input type="radio" class="btn-check" name="sex" id="f" autocomplete="off" value="f">
            <label class="btn btn-outline-primary" for="f">Female</label>
          </div>

        <input class="btn btn-primary float-end col-4" type="submit" value="Edit!">
    </form>
</body>
