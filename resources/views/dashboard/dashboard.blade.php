{{view('shared.head', ['title' => 'Dashboard'])}}
<body style="overflow-x: hidden" class="container">
    @include('shared.nav')
    <p class="text-center fs-2">Welcome to admin panel</p>
    <p class="text-center fs-4">What do you want to do?</p>
    <ul class="text-center fs-4 list-unstyled">
        <li><a href="{{route('adminTrips')}}" class="text-decoration-none fw-bold">Work on trips</a></li>
        <li><a href="{{route('adminUsers')}}" class="text-decoration-none fw-bold ">Work on users</a></li>
        <li><a href="{{route('adminReserv')}}" class="text-decoration-none fw-bold ">Work on reservations</a></li>

    </ul>
</body>
