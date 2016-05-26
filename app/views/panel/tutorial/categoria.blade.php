@extends('panel.layouts.base')

@section('content')

<article class="col-xs-12 col-sm-offset-3 col-sm-6 col-sm-offset-3 col-md-offset-3 col-md-6 col-md-offset-3 space_top_3">

<div class="mdl-card__title titulo1">
    <h2 class="title-1">{{-- # {{ $categoria->id }}: --}} {{ $categoria->titulo }}</h2><br/>
</div>

@foreach($espaoraciones as $espaoracione)
<div class="demo-card-wide mdl-card mdl-shadow--2dp">
    <div class="container-2 color-text-1 padding-top-20 padding-box-1">
        <audio id="mySound_{{ $espaoracione->aymaoracione()->getResults()->id }}" src="{{ asset($espaoracione->aymaoracione()->getResults()->audio_src) }}">
        </audio>
        <div onmouseover="PlaySound('mySound_{{ $espaoracione->aymaoracione()->getResults()->id }}')" 
               onmouseout="StopSound('mySound_{{ $espaoracione->aymaoracione()->getResults()->id }}')" class="audio">
            <img src='{{ asset("img/otros/speaker.png") }}' width="30" height="30" />
        </div>
        <span class='mdl-card__title-text'>{{ $espaoracione->aymaoracione()->getResults()->oracion }}</span><br />
        <span class='mdl-card__supporting-text-1'>{{ $espaoracione->oracion }}</span>        
        <div class="image"><img src='{{ asset($espaoracione->aymaoracione()->getResults()->imagen_src) }}'/></div> 
     </div>
 </div>
 <br>

 @endforeach
<div>
    <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="float: right; margin-bottom: 20px; background-color: #00897B;" href="{{URL::to('/panel/tutorial/actividad/'.$categoria->id)}}" role="button">
       Ir a evaluación
    </a>
</div>
</article>
<br>
<div class = "cursos_repetir">
    <div class="title_categoria">
    <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
            <i class="material-icons">more_vert</i>
    </button>
    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right">
    @foreach($seguimientos as $seguimiento)
            <li class="mdl-menu__item">
                <a href="{{URL::to('/panel/tutorial/categoria/'.$seguimiento->categoria_id)}}">
                    {{ $seguimiento->categoria_id }} {{ Categoria::find($seguimiento->categoria_id)->titulo }}
                </a>
            </li>
        
    @endforeach
    </ul>
    </div>
</div>

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