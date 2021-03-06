<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Omega</title>

    {{-- LINK BOOTSTRAP CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{--  --}}
</head>

<body>

    {{-- NAV BAR SECTION --}}
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">OMEGA</a>
        </div>

        @if (Auth::check())
            <div class="container-fluid">
                <h6>{{ Auth::user()->email }}</h6>
                <form action="/logout" method="post">
                    @csrf
                    <button class="btn btn-primary" type="submit">Выйти</button>
                </form>
            </div>
        @else
            <div class="container-fluid">
            <div class="row">
                <a class="btn btn-primary m-1" href="/register">Регистрация</a>
                <a class="btn btn-primary m-1" href="/login">Вход</a>
            </div>
                
            </div>
        @endif

    </nav>
    {{--  --}}

    @yield('body')

    {{-- BOOTSTRAP JS CDN BUNDLE --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    {{--  --}}
</body>

</html>
