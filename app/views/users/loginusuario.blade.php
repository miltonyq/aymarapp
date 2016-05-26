@extends('layouts.base')

@section('content')
<section class="row space-container">
<article class="col-xs-12 col-sm-offset-3 col-sm-6 col-sm-offset-3 col-md-offset-4 col-md-4 col-md-offset-4 cuadro-content">
<div class="cuadro-1">
<div class="mdl-card__title">
          <h2 class="title-1">Administrador</h2>
        </div>
	{{Form::open(array('method' => 'POST', 'url' => '/loginusuariopost', 'role' => 'form'))}}


	<div class="form-group">
		
		{{Form::text('username', '', array('class' => 'form-control', 'placeholder' => 'Nombre de usuario', 'autofocus'))}}
		<span class="help-block">{{ $errors->first('username') }}</span>
	</div>
	<div class="form-group">
		
		{{Form::password('password', array('class' => 'form-control', 'placeholder' => 'Contraseña'))}}
		<span class="help-block">{{ $errors->first('password') }}</span>
	</div>
	<div class="form-group">
		<p>{{Form::submit('Acceder', array('class' => 'btn btn-lg btn-primary btn-block'))}}</p>
		{{-- <p><a href="#" class="btn btn-default">Acceder</a></p> --}}
	</div>

	{{Form::close()}}

	<div class="form-group">
            <a href="{{URL::to('/')}}" class="align-left"><span class="help-block size-text-1">Ir a la plataforma</span></a>
      </div>
	{{-- <p><a href="{{URL::to('/')}}">Ir a la plataforma</a></p> --}}
</div>
</article>
</section>
@stop