{{view('shared.head', ['title' => 'All trips'])}}
<body style="overflow-x: hidden" class="container">
    @include('shared.nav')
    @include('shared.content', ['route' => 'all_filter'])
</body>
