{{view('shared.head', ['title' => 'Winter 2022/23'])}}
<body style="overflow-x: hidden" class="container">
    @include('shared.nav')
    @include('shared.content', ['route' => 'winter_filter'])
</body>
