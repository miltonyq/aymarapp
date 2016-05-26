<!DOCTYPE HTML>
<html lang="es">
<head>
  <title>
    @section('titulo')
    Iniciar|
    @show 
    Sesion 
  </title>
<meta charset="utf-8" />
<link rel="stylesheet" href="{{ URL::asset('css/material.min.css')}}">
<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}">
</head>
<body>
<section class="row space-container">

    <article class="col-xs-12 col-sm-12 col-md-6 cuadro-content">
      <div class="cuadro-1">

        <div class="mdl-card__title">
          <h2 class="title-1">Tutor Básico Aymara</h2>
        </div>

        

        <div class="form">
          {{Form::open(array('method' => 'POST', 'url' => '/loginpersonapost', 'role' => 'form'))}}

          <div class="form-group">
            {{Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Ingresa tu correo ó usuario', 'autofocus'))}}
            <span class="help-block size-text-1">{{ $errors->first('email') }}</span>
          </div>

          <div class="form-group">
            {{Form::password('password', array('class' => 'form-control', 'placeholder' => 'Contraseña'))}}
            <span class="help-block size-text-1">{{ $errors->first('password') }}</span>
          </div>

          <div class="demo-card-wide form-signin-1">
            <img src="{{URL::asset('/img/whipala.jpg')}}" alt="Habla tutor básico aymara" />
          </div> 

          <div class="form-group">
            <p>{{Form::submit('Acceder', array('class' => 'btn btn-lg btn-primary btn-block'))}}</p>
          </div>
          <div class="form-group">
            <a href="{{URL::to('/registro/get')}}" class="align-right"><span class="help-block size-text-1">¿Eres nuevo? Regístrate</span></a>
          </div>
          {{Form::close()}} 
        </div>

        <div class="mdl-card__supporting-text title-2">
            Este es un Proyecto de Grado de la materia Taller de Grado de la Carrera de Ingeniería de Sistemas en La Universidad Católica Boliviana San Pablo Regional La Paz. Realizado por la alumna Andreina Ríos Rengel
        </div>
        
        
      </div>
    </article>

    
    <article class="col-xs-12 col-sm-12 col-md-6">
      <div class="demo-card-wide mdl-card mdl-shadow--2dp form-signin-2">
        <img src="{{URL::asset('/img/whipala.jpg')}}" alt="Habla aymara" class="image-tuto" />
      </div>
    </article>
    

    {{-- <article class="row">
        <footer class="footer">
            <div class="col-xs-12 col-sm-12 col-md-12 color-text-footer">
                <span class="help-block size-text-1">
                     Copyright © 2016
                </span>
            </div>
        </footer>
    </article> --}}  


</section>
</body>
</html>
