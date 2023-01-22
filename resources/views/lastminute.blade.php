{{view('shared.head', ['title' => 'Last minute'])}}
<body style="overflow-x: hidden" class="container">
    @include('shared.nav')
    @include('shared.content', ['route' => "lastminute_filter"])
</body>
