<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOTES</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">
</head>
<body>

    {{-- @if (session()->has('user'))
        @include('top_bar')
    @endif --}}
    @yield('content')
    
    

<script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
<!--<script src="http://127.0.0.1:8000/assets/bootstrap/bootstrap.bundle.min.js"></script>--->
</body>
</html>