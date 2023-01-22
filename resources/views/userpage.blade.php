{{view('shared.head', ['title' => 'User page'])}}
<body style="overflow-x: hidden" class="container">
    @include('shared.nav')
    <div class="d-flex justify-content-center">
        <div class="text-center mt-5">
        @empty(Auth::user()->name)
            <h1>Set your personal information</h1>
        @else
            <h1>Hello {{Auth::user()->name}}</h1>
        @endempty
            <p class="fw-bold fs-4">What you want to do?</p>
            <ul class="list-unstyled fs-4">
                <li><a href="{{route('edit')}}" class="text-decoration-none fw-bold ">Edit your information</a></li>
                <li><a href="{{route('favourites')}}" class="text-decoration-none fw-bold ">Show favourites</a></li>
                <li><a href="{{route('history')}}" class="text-decoration-none fw-bold ">Your reservations</a></li>
                @if (Auth::user()->isAdmin())
                <li><a href="{{route('dashboard')}}" class="text-decoration-none fs-2 font-monospace fw-bold ">Go to dashboard</a></li>
                @endif

            </ul>
            <form method="POST" action="{{route('logout')}}">
                @csrf
                <button class="btn btn-secondary" type="submit">Logout</button>
            </form>
        </div>
    </div>
</body>


