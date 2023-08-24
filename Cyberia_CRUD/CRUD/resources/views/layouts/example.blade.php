<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Онлайн библиотека@yield('title')</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('integrations/header')
    <div class="container mt-5 mb-5">
        @yield('content')
    </div>
    <div class="bg-dark">
        @include('integrations/footer')
    </div>
</body>
</html>
