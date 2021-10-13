<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('scripts')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@tabler/icons@latest/iconfont/tabler-icons.min.css"> <!-- font icon -->
    @stack('styles')

</head>
<body>
    <div id="app">
        <x-navbar />

            <div class="mx-4">
                <div class="row justify-content-center py-4">
                    <div class="col-md-12">
                         <x-alert />
                    </div>
                    @auth
                    <div class="col-md-2">
                        <x-side-bar />
                    </div>
                    @endauth
                    <div class="col-md-10">
                        <main>
                            @yield('content')
                        </main>
                    </div>
                </div>
            </div>
    </div>
</body>
</html>
