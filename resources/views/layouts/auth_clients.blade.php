<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $pageTitle }} - Unicode Academy</title>
    @vite(['resources/sass/app.scss'])
    @yield('stylesheets')
</head>

<body>
    @yield('content')
</body>

@vite(['resources/js/app.js'])
@yield('scripts')

</html>