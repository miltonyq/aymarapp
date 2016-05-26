@extends('layouts.base')

@section('content')

	{{Form::open(array('method' => 'POST', 'url' => '/guardarusuario', 'role' => 'form'))}}

	<div class="form-group">
		{{Form::label('Usuario')}}
		{{Form::text('nombrecompleto', '', array('class' => 'form-control'))}}
		<span class="help-block">{{ $errors->first('nombrecompleto') }}</span>
	</div>
	<div class="form-group">
		{{Form::label('email')}}
		{{Form::text('email', '', array('class' => 'form-control'))}}
		<span class="help-block">{{ $errors->first('email') }}</span>
	</div>
	<div class="form-group">
		{{Form::label('Contraseña')}}
		{{Form::password('password', array('class' => 'form-control'))}}
		<span class="help-block">{{ $errors->first('password') }}</span>
	</div>
	<div class="form-group">
		{{Form::label('Repite la contraseña')}}
		{{Form::password('password2', array('class' => 'form-control'))}}
		<span class="help-block">{{ $errors->first('password2') }}</span>
	</div>
	<div class="form-group">
		<p>{{Form::submit('Registrarme', array('class' => 'btn btn-default'))}}</p>
	</div>

	{{Form::close()}}

@stop