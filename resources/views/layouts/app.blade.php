<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.headerlink')
<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('layouts.footerlink')
</body>
</html>
