<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'TeAcercoSalud - Tienda' }}</title>

    {{-- CSS principal --}}
    <link rel="stylesheet" href="{{ url('css/app.css') }}">

    {{-- Bootstrap y Font Awesome --}}
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">

    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- Fuente --}}
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>

<body>
    <div id="app">

        {{-- 🔹 Ya no incluimos @include('partials.navbar')
             porque el navbar está directamente en la vista `cart.blade.php` --}}

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    {{-- Scripts al final del body (orden correcto) --}}
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha384-tsQFQP8V6gDq5l7hC2pBfef+5tH+1VEGZrQvJ4Z9FzkkhRZ5o3c5zFhZf+8Lq3lW"
            crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
</body>
</html>
