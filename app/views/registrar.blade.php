<!DOCTYPE HTML>
<html lang="es">
<head>
    <title>
        @section('titulo')
            Registrarse|
        @show 
            Persona 
    </title>
   <meta charset="utf-8" />
<link rel="stylesheet" href="{{ URL::asset('css/material.min.css')}}">
<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}">

</head>
<body>

<article class="col-xs-12 col-sm-offset-3 col-sm-6 col-sm-offset-3 col-md-offset-3 col-md-6 col-md-offset-3">
  <div class="mdl-card__title" style="margin-top: 30px;">
    <h2 class="title-1">Registro de nueva persona</h2>
  </div>

     {{Form::open(array('method' => 'POST', 'url' => '/registro/post', 'role' => 'form','files' => true))}}


     <div class="form-group">
      {{Form::text('username', '', array('class' => 'form-control', 'placeholder' => 'Nick de persona'))}}
      <span class="help-block">{{ $errors->first('username') }}</span>
    </div>
    <div class="form-group">
      {{Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Email'))}}
      <span class="help-block">{{ $errors->first('email') }}</span>
    </div>
    <div class="form-group">
      {{Form::password('password', array('class' => 'form-control', 'placeholder' => 'Contraseña'))}}
      <span class="help-block">{{ $errors->first('password') }}</span>
    </div>
    <div class="form-group">
      {{Form::password('password2', array('class' => 'form-control', 'placeholder' => 'Repite la contraseña'))}}
      <span class="help-block">{{ $errors->first('password2') }}</span>
    </div>
    <div class="form-group">
      {{Form::text('nombres', '', array('class' => 'form-control', 'placeholder' => 'Nombres'))}}
      <span class="help-block">{{ $errors->first('nombres') }}</span>
    </div>
    <div class="form-group">
      {{Form::text('apellidos', '', array('class' => 'form-control', 'placeholder' => 'Apellidos'))}}
      <span class="help-block">{{ $errors->first('apellidos') }}</span>
    </div>
    <div class="form-group">
      {{Form::text('edad', '', array('class' => 'form-control', 'placeholder' => 'Edad'))}}
      <span class="help-block">{{ $errors->first('edad') }}</span>
    </div>

    <div class="row form-group">
        <div class="col-xs-offset-1 col-xs-10 col-xs-offset-1 col-sm-offset-2 col-sm-8 col-sm-offset-2 col-md-offset-3 col-md-6 col-md-offsetmd" style="text-align: center; padding-bottom: 20px;">
            <div style="display: inline-block;padding-right: 50px;">
                {{Form::radio('sexo', 1, true, array('class' => 'form-control'))}}
                <span style=" font-weight: bold;">Varón</span>
            </div>
            <div style="display: inline-block;">
                {{Form::radio('sexo', 0, false, array('class' => 'form-control'))}}
                <span style=" font-weight: bold;">Mujer</span>
            </div>
        </div>
    </div>

    {{-- <div class="form-group">
      {{Form::label('Avatar_Imagen')}}
      {{Form::text('avatar_src', '', array('class' => 'form-control'))}}
      <span class="help-block">{{ $errors->first('avatar_src') }}</span>
    </div> --}}
    <div class="form-group">
      {{ Form::label('imagen', 'Seleccione Imagen ') }}
      {{ Form::file('imagen') }}
      <span class="help-block">{{ $errors->first('imagen') }}</span>
    </div>  
    <div class="form-group">
      <p>{{Form::submit('Registrarse', array('class' => 'btn btn-lg btn-success btn-block'))}}</p>
    </div>

    {{Form::close()}}
</article>
</body>
</html>
