@extends('layouts.base')

@section('content')

	{{Form::open(array('method' => 'POST', 'url' => '/login', 'role' => 'form'))}}

	@if(Session::has('registro'))
		<h3>{{Session::get('registro')}}</h3></br>
	@endif

	<div class="form-group">
		{{Form::label('Usuario')}}
		{{Form::text('username', '', array('class' => 'form-control'))}}
		<span class="help-block">{{ $errors->first('username') }}</span>
	</div>
	<div class="form-group">
		{{Form::label('Contraseña')}}
		{{Form::password('password', array('class' => 'form-control'))}}
		<span class="help-block">{{ $errors->first('password') }}</span>
	</div>
	<div class="form-group">
		<p>{{Form::submit('Acceder', array('class' => 'btn btn-default'))}}</p>
		<p><a href="/signup" class="btn btn-default">Registrarme</a></p>
	</div>

	{{Form::close()}}

@stop