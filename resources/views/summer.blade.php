{{view('shared.head', ['title' => 'Summer 2022'])}}
<body style="overflow-x: hidden" class="container">
    @include('shared.nav')
    @include('shared.content', ['route' => 'summer_filter'])
</body>
