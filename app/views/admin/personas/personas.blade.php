@extends('admin.layouts.base')

@section('content')

<article class="col-xs-12 col-sm-offset-3 col-sm-6 col-sm-offset-3 col-md-offset-3 col-md-6 col-md-offset-3">
	<div class="mdl-card__title" style="margin-top: 30px;">
		<h2 class="title-1">Registro de nueva persona</h2>
	</div>
	@if(!isset($persona))
	
	{{Form::open(array('method' => 'POST', 'url' => '/administrador/personas/add', 'role' => 'form'))}}

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
	<p>{{Form::submit('Registrar Persona', array('class' => 'btn btn-lg btn-success btn-block'))}}</p>
</div>

{{Form::close()}}	

@else
<h3>Editar persona</h3>
<br>
{{Form::open(array('method' => 'POST', 'url' => '/administrador/personas/edit/'.$persona->id, 'role' => 'form'))}}

<div class="form-group">
	{{Form::label('Nick de persona')}}
	{{Form::text('username', $persona->username, array('class' => 'form-control'))}}
	<span class="help-block">{{ $errors->first('username') }}</span>
</div>
<div class="form-group">
	{{Form::label('Email')}}
	{{Form::text('email', $persona->email, array('class' => 'form-control'))}}
	<span class="help-block">{{ $errors->first('email') }}</span>
</div>
<div class="form-group">
	{{Form::label('Nombres')}}
	{{Form::text('nombres', $persona->nombres, array('class' => 'form-control'))}}
	<span class="help-block">{{ $errors->first('nombres') }}</span>
</div>
<div class="form-group">
	{{Form::label('Apellidos')}}
	{{Form::text('apellidos', $persona->apellidos, array('class' => 'form-control'))}}
	<span class="help-block">{{ $errors->first('apellidos') }}</span>
</div>
<div class="form-group">
	{{Form::label('Edad')}}
	{{Form::text('edad', $persona->edad, array('class' => 'form-control'))}}
	<span class="help-block">{{ $errors->first('edad') }}</span>
</div>
<div class="form-group">
	@if($persona->sexo == true)  
	{{ Form::label('varon') }}
	{{ Form::radio('sexo', 1, true) }}
	{{ Form::label('mujer') }}
	{{ Form::radio('sex', 0) }}
	@else
	{{ Form::label('varon') }}
	{{ Form::radio('sexo', 1) }}
	{{ Form::label('mujer') }}
	{{ Form::radio('sexo', 0, true) }}
	@endif
	
</div>
{{--<div class="form-group">
	{{Form::label('Avatar_Imagen')}}
	{{Form::text('avatar_src', $persona->avatar_src, array('class' => 'form-control'))}}
	<span class="help-block">{{ $errors->first('avatar_src') }}</span>
</div>  --}}

<div class="form-group">
	<p>{{Form::submit('Modificar Persona', array('class' => 'btn btn-default'))}}</p>
</div>

{{Form::close()}}	

@endif
</article>
<article class="col-xs-12 col-sm-offset-2 col-sm-8 col-sm-offset-2 col-md-offset-1 col-md-10 col-md-offset-1">
	@if(count($personas) > 0)	
	<div class="table-responsive">		
	<table  class="table table-striped">
		<thead>
			<tr class="table_title" style="background-color: #757575">
				<td>Nombre de usuario</td>
				<td>Email</td>
				<td>Nombres</td>
				<td>Apellidos</td>
				<td>Edad</td>
				<td>Sexo</td>
				<td>Avatar(imagen)</td>
				<td>Acción</td>
			</tr>
		</thead>
		<tbody>
			@foreach($personas as $persona)
			<tr>
				<td>{{ $persona->username }}</td>
				<td>{{ $persona->email }}</td>
				<td>{{ $persona->nombres }}</td>
				<td>{{ $persona->apellidos }}</td>
				<td>{{ $persona->edad }}</td>
				<td>
					@if($persona->sexo == true)  
					varon
					@else
					mujer
					@endif
				</td>
				<td>{{ $persona->avatar_src }}</td>
				<td>
					<a href="{{URL::to('/administrador/personas/edit/'.$persona->id)}}" >
						Editar
					</a>
					<a href="{{URL::to('/administrador/personas/delete/'.$persona->id)}}" >
						Eliminar
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	</div>
	@else
	No hay personas aún !!!
	@endif
</article>

@stop
