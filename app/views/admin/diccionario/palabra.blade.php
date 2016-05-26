@extends('admin.layouts.base')

@section('content')

<article class="col-xs-12 col-sm-offset-3 col-sm-6 col-sm-offset-3 col-md-offset-3 col-md-6 col-md-offset-3" style="margin-top: 30px;">

@if(!isset($espapal))
<div class="mdl-card__title">
    <h2 class="title-1">Adicionar nueva palabra al diccionario</h2>
</div>

{{Form::open(array('method' => 'POST', 'url' => '/administrador/nueva_palabra/add', 'role' => 'form','files' => true))}}

<div class="form-group">
	{{Form::label('Palabra en Español :')}}
	{{Form::text('palabra_esp', '', array('class' => 'form-control'))}}
	<span class="help-block">{{ $errors->first('palabra_esp') }}</span>
</div>
<div class="form-group">
    {{Form::label('Palabra en Aymara (Traducción) :')}}
    {{Form::text('palabra_aym', '', array('class' => 'form-control'))}}
    <span class="help-block">{{ $errors->first('palabra_aym') }}</span>
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
	<p>{{Form::submit('Adicionar', array('class' => 'btn btn-success'))}}</p>
</div>
{{Form::close()}}

@else

<div class="mdl-card__title">
    <h2 class="title-1">Editar palabra del diccionario</h2>
</div>

{{Form::open(array('method' => 'POST', 'url' => '/administrador/palabra/edit/'.$espapal->id, 'role' => 'form','files' => true))}}

<div class="form-group">
    {{Form::label('Palabra en Español :')}}
    {{Form::text('palabra_esp', $espapal->palabra, array('class' => 'form-control'))}}
    <span class="help-block">{{ $errors->first('palabra_esp') }}</span>
</div>
<div class="form-group">
    {{Form::label('Palabra en Aymara (Traducción) :')}}
    {{Form::text('palabra_aym', $espapal->aymapal()->getResults()->palabra, array('class' => 'form-control'))}}
    <span class="help-block">{{ $errors->first('palabra_aym') }}</span>
</div>
<p><img src='{{ asset($espapal->aymapal()->getResults()->imagen_src) }}' width="70" height="70"/></p>
<div class="form-group">
   {{ Form::label('imagen', 'Subir Nueva Imagen Aymara: ') }}
   {{ Form::file('imagen') }}
   <span class="help-block">{{ $errors->first('imagen') }}</span>
</div>  
<audio id="miSonido" src="{{ asset($espapal->aymapal()->getResults()->audio_src) }}"></audio>
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

    @if(count($espapals) > 0)
    <table  class="table table-striped">
        <thead>
            <tr class="table_title">
                <td>#</td>
                <td>Palabra en Español</td>
                <td>Palabra en Aymara (Traducción)</td>
                <td>Imagen Aymara</td>
                <td>Audio Aymara</td>
                <td>Acción</td>
            </tr>
        </thead>
        <tbody>
            @foreach($espapals as $espapal)
            <tr>
                <td>{{ $espapal->id }}</td>
                <td>{{ $espapal->palabra }}</td>
                <td>{{ $espapal->aymapal()->getResults()->palabra }}</td>
                <td><img src='{{ asset($espapal->aymapal()->getResults()->imagen_src) }}' width="70" height="70"/></td>
                <td><audio id="mySound_{{ $espapal->aymapal()->getResults()->id }}" src="{{ asset($espapal->aymapal()->getResults()->audio_src) }}"></audio>
                
                <p onmouseover="PlaySound('mySound_{{ $espapal->aymapal()->getResults()->id }}')" 
                onmouseout="StopSound('mySound_{{ $espapal->aymapal()->getResults()->id }}')"><img src='{{ asset("img/otros/speaker.png") }}' width="30" height="30" /></p>
                
                </td>
                <td>
                    <a href="{{URL::to('/administrador/palabra/edit/'.$espapal->id)}}" >
                         Editar
                    </a>
                    <a href="{{URL::to('/administrador/palabra/delete/'.$espapal->id)}}" >
                        Eliminar
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No hay Palabras aún !!! </p>
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
