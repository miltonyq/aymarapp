<!DOCTYPE HTML>
<html lang="es">
<head>
    <title>
        @section('titulo')
            Usuario
        @show 
        {{-- Esto es un comentario --}}
         | {{--Site::find(1)->name--}}
         Admin
    </title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="{{ URL::asset('css/material.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}">
    @yield('css')
    @yield('js')

</head>
<body>

                {{--<h1>Site::find(1)->name
                 Asministrador
                </h1>--}}
        
        
                @yield('content')
           
                {{-- @include('layouts/loginfooter') --}}
                
                {{--<footer>
                    Site::find(1)->footer
                    <p>Copyright 2015</p>
                </footer>--}}

</body>
</html>