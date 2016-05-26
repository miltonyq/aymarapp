<!DOCTYPE HTML>
<html lang="es">
<head>
    <title>
        @section('titulo')
            Tutor
        @show
         | Inteligente
     </title>
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <link rel="stylesheet" href="{{ URL::asset('css/material.min.css')}}">
     <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
     <link rel="stylesheet" href="{{ URL::asset('css/admin.css') }}">
     <link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}">
     <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}">
     @yield('css')
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     <script src="{{ URL::asset('js/bootstrap.js') }}" type="text/javascript" charset="utf-8" async defer></script>
     <script src="{{ URL::asset('js/material.min.js') }}" type="text/javascript" charset="utf-8" async defer></script>
     @yield('js')
     @yield('js')
 </head>
<body>

  <div class="demo-layout-transparent mdl-layout mdl-js-layout">
    <header class="mdl-layout__header mdl-layout__header--transparent">
      <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title">AYMARAPP</span>
        <!-- Add spacer, to align navigation to the right -->
        <div class="mdl-layout-spacer"></div>
        <!-- Navigation -->
        <nav class="mdl-navigation">
              {{-- <a class="mdl-navigation__link" href="">Link</a>
              <a class="mdl-navigation__link" href="">Link</a>
              <a class="mdl-navigation__link" href="">Link</a> --}}
              <a class="mdl-navigation__link" href="#">Bienvenido {{Session::get('persona_username')}}</a>
            </nav>
          </div>
        </header>
        <div class="mdl-layout__drawer">
          <span class="mdl-layout-title mdl-layout-title-menu" style="padding-left: 35px;">
            AYMARAPP<br/>
            <span class="mdl-navigation__link title_3" href="#" style="text-align: center;">Bienvenido {{Session::get('persona_username')}}</span>
          </span>
          
          <nav class="mdl-navigation">
            <div class="content_image_person">
              <img src="{{ asset(Persona::find(Session::get('persona_id'))->avatar_src )}}" height="40" width="40" class="image_person"/>
            </div>
            <a class="mdl-navigation__link" href="{{URL::to('/panel')}}">Inicio</a>
            <a class="mdl-navigation__link" href="{{URL::to('/panel/busca_trad/get')}}">Diccionario</a>
            <a class="mdl-navigation__link" href="{{URL::to('/panel/tutorial/categoria/'.Session::get('categoria_id'))}}">Tutorial</a>
            <a class="mdl-navigation__link" href="{{URL::to('/panel/tutorial/categoria_notas/get')}}">Mis Notas</a>
            <a class="mdl-navigation__link" href="{{URL::to('/personalogout')}}">Desconectarse</a>
          </nav>
        </div>

        <main class="mdl-layout__content row">
          @yield('content')
        </main>
</div>

    <!-- JS -->
            
</body>
</html>