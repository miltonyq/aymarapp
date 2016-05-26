@extends('admin.layouts.base')

@section('content')

<article class="col-xs-12 col-sm-offset-3 col-sm-6 col-sm-offset-3 col-md-offset-3 col-md-6 col-md-offset-3" style="margin-top: 30px;">

@if(!isset($categoria))
<div class="mdl-card__title">
        <h2 class="title-1">Agregar Nueva Categoria para Tutorial</h2><br/>
</div>
{{Form::open(array('method' => 'POST', 'url' => '/administrador/categorias/add', 'role' => 'form'))}}

<div class="form-group">
    {{Form::label('Titulo de la Categoria :')}}
    {{Form::text('titulo', '', array('id' => 'titulo_tut','class' => 'form-control'))}}
    <span class="help-block">{{ $errors->first('titulo') }}</span>
</div>

<div class="form-group align-right">
    <p>{{Form::submit('Registrar', array('class' => 'btn btn-success'))}}</p>
</div>

{{Form::close()}}

@else

<div class="mdl-card__title">
        <h2 class="title-1">Editar Categoria para Tutorial</h2><br/>
</div>
{{Form::open(array('method' => 'POST', 'url' => '/administrador/categorias/edit/'.$categoria->id, 'role' => 'form'))}}

<div class="form-group">
    {{Form::label('Titulo de la Categoria :')}}
    {{Form::text('titulo', $categoria->titulo, array('id' => 'titulo_tut','class' => 'form-control'))}}
    <span class="help-block">{{ $errors->first('titulo') }}</span>
</div>

<div class="form-group align-right">
    <p>{{Form::submit('Registrar Modificación', array('class' => 'btn btn-success '))}}</p>
</div>

{{Form::close()}}

@endif

</article>
<article class="col-xs-12 col-sm-offset-3 col-sm-6 col-sm-offset-3 col-md-offset-3 col-md-6 col-md-offset-3">

    @if(count($categorias) > 0)
    <table  class="table table-striped">
    	<thead>
    		<tr class="table_title">
    			<td>#</td>
                <td>Titulo</td>
                <td>Admin Oraciones</td>
    			<td>Acción</td>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach($categorias as $categoria)
    		<tr>
                <td>{{ $categoria->id }}</td>
    			<td>{{ $categoria->titulo }}</td>
                <td><a href="{{URL::to('/administrador/categorias/oraciones/'.$categoria->id)}}">Administrar</a></td>
    			<td>
    				<a href="{{URL::to('/administrador/categorias/edit/'.$categoria->id)}}" >
    					 Editar
    				</a>
    				<a href="{{URL::to('/administrador/categorias/delete/'.$categoria->id)}}" >
    					Eliminar
    				</a>
    			</td>
    		</tr>
    		@endforeach
    	</tbody>
    </table>
    @else
    <p>No hay Categorias aún !!! </p>
    @endif		

</article>


@stop
