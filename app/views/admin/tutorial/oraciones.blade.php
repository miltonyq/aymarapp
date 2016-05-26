@extends('admin.layouts.base')

@section('content')

<article class="col-xs-12 col-sm-offset-3 col-sm-6 col-sm-offset-3 col-md-offset-3 col-md-6 col-md-offset-3" style="margin-top: 30px;">
<h1>{{ $categoria->titulo }}</h1>

@if(!isset($espaoracione))
<div class="mdl-card__title">
        <h2 class="title-1">Agregar Nueva Oración para Tutorial</h2><br/>
</div>
{{Form::open(array('method' => 'POST', 'url' => '/administrador/categorias/oraciones/'.$categoria->id.'/add', 'role' => 'form','files' => true))}}

<div class="form-group">
    {{Form::label('Oración en Español :')}}
    {{Form::text('oracion_esp', '', array('id' => 'oracion_esp','class' => 'form-control'))}}
    <span class="help-block">{{ $errors->first('oracion_esp') }}</span>
</div>

<div class="form-group">
    {{Form::label('Oración en Aymara (Traducción) :')}}
    {{Form::text('oracion_aym', '', array('id' => 'oracion_aym','class' => 'form-control'))}}
    <span class="help-block">{{ $errors->first('oracion_aym') }}</span>
</div>

<div class="form-group">
      {{ Form::label('imagen', 'Subir Imagen Aymara: ') }}
      {{ Form::file('imagen') }}
      <span class="help-block">{{ $errors->first('imagen') }}</span>
</div>  

<div class="form-group">
      {{ Form::label('audio', 'Subir Audio Aymara: ') }}
      {{ Form::file('audio') }}
      <span class="help-block">{{ $errors->first('audio') }}</span>
</div>

<div class="form-group">
    <p>{{Form::submit('Registrar', array('class' => 'btn btn-default'))}}</p>
</div>

{{Form::close()}}

@else

<div class="mdl-card__title">
        <h2 class="title-1">Editar Oración de Tutorial</h2><br/>
</div>
{{Form::open(array('method' => 'POST', 'url' => '/administrador/categorias/oraciones/'.$categoria->id.'/edit/'.$espaoracione->id, 'role' => 'form','files' => true))}}

<div class="form-group">
    {{Form::label('Oración en Español :')}}
    {{Form::text('oracion_esp', $espaoracione->oracion, array('id' => 'oracion_esp','class' => 'form-control'))}}
    <span class="help-block">{{ $errors->first('oracion_esp') }}</span>
</div>

<div class="form-group">
    {{Form::label('Oración en Aymara (Traducción) :')}}
    {{Form::text('oracion_aym', $espaoracione->aymaoracione()->getResults()->oracion, array('id' => 'oracion_aym','class' => 'form-control'))}}
    <span class="help-block">{{ $errors->first('oracion_aym') }}</span>
</div>
<p><img src='{{ asset($espaoracione->aymaoracione()->getResults()->imagen_src) }}' width="70" height="70"/></p>
<div class="form-group">
      {{ Form::label('imagen', 'Subir Nueva Imagen Aymara: ') }}
      {{ Form::file('imagen') }}
      <span class="help-block">{{ $errors->first('imagen') }}</span>
</div>  

<audio id="miSonido" src="{{ asset($espaoracione->aymaoracione()->getResults()->audio_src) }}"></audio>
<p onmouseover="PlaySound('miSonido')" 
    onmouseout="StopSound('miSonido')"><img src='{{ URL::asset("img/otros/speaker.png") }}' width="30" height="30"/></p>

<div class="form-group">
      {{ Form::label('audio', 'Subir Nuevo Audio Aymara: ') }}
      {{ Form::file('audio') }}
      <span class="help-block">{{ $errors->first('audio') }}</span>
</div>
<div class="form-group">
    <p>{{Form::submit('Registrar Modificación', array('class' => 'btn btn-default'))}}</p>
</div>

{{Form::close()}}

@endif

</article>
<article class="col-xs-12 col-sm-offset-3 col-sm-6 col-sm-offset-3 col-md-offset-3 col-md-6 col-md-offset-3">

    @if(count($espaoraciones) > 0)
    <table  class="table table-striped">
    	<thead>
    		<tr class="table_title">
    			<td>#</td>
                <td>Oración en Español</td>
                <td>Oración en Aymara (Traducción)</td>
                <td>Imagen Aymara</td>
                <td>Audio Aymara</td>
    			<td>Acción</td>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach($espaoraciones as $espaoracione)
    		<tr>
                <td>{{ $espaoracione->id }}</td>
    			<td>{{ $espaoracione->oracion }}</td>
                <td>{{ $espaoracione->aymaoracione()->getResults()->oracion }}</td>
                <td><img src='{{ asset($espaoracione->aymaoracione()->getResults()->imagen_src) }}' width="70" height="70"/></td>
                <td><audio id="mySound_{{ $espaoracione->aymaoracione()->getResults()->id }}" src="{{ asset($espaoracione->aymaoracione()->getResults()->audio_src) }}"></audio>
                
                <p onmouseover="PlaySound('mySound_{{ $espaoracione->aymaoracione()->getResults()->id }}')" 
                onmouseout="StopSound('mySound_{{ $espaoracione->aymaoracione()->getResults()->id }}')"><img src='{{ asset("img/otros/speaker.png") }}' width="30" height="30" /></p>
                
                </td>
    			<td>
    				<a href="{{URL::to('/administrador/categorias/oraciones/'.$categoria->id.'/edit/'.$espaoracione->id)}}" >
    					 Editar
    				</a>
    				<a href="{{URL::to('/administrador/categorias/oraciones/'.$categoria->id.'/delete/'.$espaoracione->id)}}" >
    					Eliminar
    				</a>
    			</td>
    		</tr>
    		@endforeach
    	</tbody>
    </table>
    @else
    <p>No hay Oraciones aún !!! </p>
    @endif		

</article>

<script type="text/javascript">

function PlaySound(soundobj) {
    console.log(soundobj);
    var thissound=document.getElementById(soundobj);
    thissound.play();
}

function StopSound(soundobj) {
    console.log(soundobj);
    var thissound=document.getElementById(soundobj);
    thissound.pause();
    thissound.currentTime = 0;
}

</script>

@stop
