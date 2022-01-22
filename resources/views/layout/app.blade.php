<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Food App</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/jquery-3.2.1.slim.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<body>
    {{-- navbar --}}
    @if (Auth::check())
        <nav class="navbar navbar-dark bg-dark justify-content-between">
            <div class="btn-sm btn-success">{{ Auth::user()->username }}</div>
            <a class='btn btn-danger btn-sm my-2 my-sm-0' href="{{ route('logout') }}">Sign Out</a>
        </nav>
    @endif

    <div class="container">
        @yield('content')
    </div>
</body>
</html>