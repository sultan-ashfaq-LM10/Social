<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" media="screen" href="{{asset('css/app.css')}}">

</head>
<script>
    window.Laravel = {csrfToken: '{{ csrf_token() }}'};

</script>

<body>
    <div id="app">
        <transition name="slide-fade" mode="out-in">
            <router-view :auth-check="{{ Auth::check() ? 'true': 'false' }}"></router-view>
        </transition>
    </div>
    <script src="{{asset('/js/app.js')}}"></script>
</body>
</html>
