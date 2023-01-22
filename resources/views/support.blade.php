{{view('shared.head', ['title' => 'Support'])}}
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
    <div>
        <h3 class="ms-5 mt-3">Select complaint category</h3>
            <form id="question" class="needs-validation mt-3" method="POST" action="{{route('supportMail')}}">
                @csrf
                <select name="type" class="form-select border border-primary mb-3 mx-auto" style="width: 80%">
                    @if(Auth::check() && Auth::user()->reservations()->exists())
                        <option>Return</option>
                        <option>Complaint</option>
                    @endif
                    <option selected>Question</option>
                    <option>Webpage bugs</option>
                </select>
            <input name="mail" type="email" id="mail" placeholder="Type your email" required class="border border-primary form-control mx-auto" style="width: 80%" value="@if (Auth::check())
            {{Auth::user()->email}}
            @endif"/>
            @if(Auth::check())
                <select name="trip" class="border border-primary form-select mt-3 mx-auto
                @error('trip')
                is-invalid
                @enderror" style="width: 80%">
                    <option>None</option>
                    @forelse($trips as $trip)
                        <option>{{$trip->findTrip()->city}}, {{$trip->findTrip()->country}} from {{$trip->findTrip()->begin_date}} to {{$trip->findTrip()->end_date}}</option>
                    @empty
                        <option disabled>You don't have any reservations. 😥 We are waiting for you!</option>
                    @endforelse
                </select>
            @endif
            <br/>
            <textarea name="message" id="textarea" placeholder="What's the problem?" class="border border-primary form-control mx-auto
            @error('message')
            is-invalid
            @enderror" form="question" required style="resize: none; width: 80%; height: 20vh"></textarea><br/>
            <button type="submit" class="float-end btn btn-primary fs-3" style="margin-right: 10%">Send!</button>
        </form>
    </div>
</body>


