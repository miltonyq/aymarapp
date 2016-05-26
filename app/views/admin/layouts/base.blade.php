<!DOCTYPE HTML>
<html lang="es">
<head>
	<title>
		@section('titulo')
			Página principal
		@show 
		 | Administrar
	</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="{{ URL::asset('css/admin.css') }}">

	<link rel="stylesheet" href="{{ URL::asset('css/material.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('css/styles.css')}}">
	@yield('css')
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="{{ URL::asset('js/bootstrap.js') }}" type="text/javascript" charset="utf-8" async defer></script>
	<script src="{{ URL::asset('js/material.min.js') }}" type="text/javascript" charset="utf-8" async defer></script>
	@yield('js')

	<!-- CSS -->

</head>
<body>

<div class="demo-layout-transparent mdl-layout mdl-js-layout">
    <header class="mdl-layout__header mdl-layout__header--transparent">
      <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title">Panel de Administración</span>
        <!-- Add spacer, to align navigation to the right -->
        <div class="mdl-layout-spacer"></div>
        <!-- Navigation -->
        <nav class="mdl-navigation">
              {{-- <a class="mdl-navigation__link" href="">Link</a>
              <a class="mdl-navigation__link" href="">Link</a>
              <a class="mdl-navigation__link" href="">Link</a> --}}
              <span class="mdl-navigation__link">Bienvenido {{Session::get('user_username')}}</span>
            </nav>
          </div>
        </header>
        <div class="mdl-layout__drawer">
          <span class="mdl-layout-title mdl-layout-title-menu">
            Opciones
          </span>
          
          <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="{{URL::to('/administrador')}}">Inicio</a>
            <a class="mdl-navigation__link" href="{{URL::to('/administrador/personas')}}">Administrar Personas</a>
            <a class="mdl-navigation__link" href="{{URL::to('/administrador/nueva_palabra/get')}}">Administrar Diccionario</a>
            <a class="mdl-navigation__link" href="{{URL::to('/administrador/categorias')}}">Categorias</a>
            <a class="mdl-navigation__link" href="{{URL::to('/usuariologout')}}">Desconectarse</a>
          </nav>
        </div>

        <main class="mdl-layout__content row">
          @yield('content')
        </main>
</div>

	<!-- JS -->
	
</body>
</html>