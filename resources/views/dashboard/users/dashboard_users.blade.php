{{view('shared.head', ['title' => 'Work on users'])}}
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
            <th>Email</th>
            <th>Passowrd</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Phone</th>
            <th>Sex</th>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{$user->email}}</td>
                <td>{{$user->password}}</td>
                @isset($user->name)
                    <td>{{$user->name}}</td>
                @else
                    <td>Not setted</td>
                @endisset
                @isset($user->surname)
                    <td>{{$user->surname}}</td>
                @else
                    <td>Not setted</td>
                @endisset
                @isset($user->phone)
                    <td>{{$user->phone}}</td>
                @else
                    <td>Not setted</td>
                @endisset
                @isset($user->sex)
                    <td>{{$user->sex}}</td>
                @else
                    <td>Not setted</td>
                @endisset
                <td>
                    <form class="form" method="GET" action="{{route('adminUsersEdit')}}">
                        <input type="hidden" value="{{$user->id}}" readonly name="id">
                        <input class="btn btn-outline-primary" type="submit" value="Edit user">
                    </form>
                </td>

                <td>
                    <form class="form" method="POST" action="{{route('adminUsersDelete')}}" >
                        @csrf
                        <input type="hidden" value="{{$user->id}}" readonly name="id">
                        <input class="btn btn-outline-primary" type="submit" value="Delete user">
                    </form>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
</body>
