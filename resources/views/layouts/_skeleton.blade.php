<!DOCTYPE html>
<html lang="id">
<head>
    <title>@yield('page-title', 'Home') &mdash; {{ config('app.name') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Project 2" />
    <meta name="keywords" content="Project, web" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="@yield('title', 'Home') &mdash; {{ config('app.name') }}" />
    <meta property="og:url" content="{{ config('app.url') }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <link rel="canonical" href="{{ config('app.url') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    @stack('style')
    @livewireStyles
    @vite([])
    @include('sweetalert::alert')
</head>
@yield('body')
@yield('modal')
<script>
    var hostUrl = "{{ asset('assets/') }}";
</script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script>
    window.addEventListener('alert', event => {
        toastr[event.detail.type](event.detail.message);
    });
</script>
@stack('js')
@livewireScripts
@powerGridScripts
</body>
</html>
