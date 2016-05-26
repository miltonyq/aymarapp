@extends('panel.layouts.base')

@section('content')

<article class="col-xs-12 col-sm-offset-3 col-sm-6 col-sm-offset-3 col-md-offset-3 col-md-6 col-md-offset-3 space_top_3 align_center">

<div class="mdl-card__title">
    <h2 class="title-1">{{-- # {{ $categoria->id }}: --}} {{ $categoria->titulo }}  <strong>Actividad Evaluar</strong></h2><br/>
</div>
@if(Session::has('aprob') && Session::has('puntos') && Session::has('terminado'))

    @if(Session::get('aprob') == true)

    <div class="demo-card-event mdl-card mdl-shadow--2dp score color_aprob"> 
      <div class="mdl-card__title mdl-card--expand align_center">
        <h3 class="font_1">Aprobaste con</h3>
      </div>
      <div class="mdl-card__actions mdl-card--border">
        <span class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect height_card_1">
          <h2>{{ Session::get('puntos') }}</h2>
        </span>
        <div class="mdl-layout-spacer"></div>
      </div>
    </div>


       {{-- <p>Aprobaste con: </p>
       <p><strong> {{ Session::get('puntos') }}</strong></p> --}}
    @else
    
    <div class="demo-card-event mdl-card mdl-shadow--2dp score color_repro"> 
      <div class="mdl-card__title mdl-card--expand align_center">
        <h3 class="font_1">Reprobaste con</h3>
      </div>
      <div class="mdl-card__actions mdl-card--border">
        <span class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect height_card_1">
          <h2>{{ Session::get('puntos') }}</h2>
        </span>
        <div class="mdl-layout-spacer"></div>
      </div>
    </div>


      {{-- <p>Reprobaste con: </p>
       <p><strong> {{ Session::get('puntos') }}</strong></p> --}}
       <a class="align-right" href="{{URL::to('/panel/tutorial/categoria/'.Session::get('categoria_id'))}}"><span class="help-block size-text-1">Intentalo de nuevo !!!</span></a>
    @endif

    @if(Session::get('terminado') == true)

    <div class="mdl-card__title mdl-card--expand align_center">
        <h3 class="font_1 color_terminar">Terminaste el tutorial</h3>
    </div>
        
      
    {{-- <p style="font-size:20px"><strong>Terminaste el tutorial</strong></p> --}}
    @endif
    
@else

    <div class="demo-card-event mdl-card mdl-shadow--2dp score"> 
      <div class="mdl-card__title mdl-card--expand align_center">
        <h3 class="font_1">No hay actividad para evaluar</h3>
        <a href="{{URL::to('/panel/tutorial/categoria/'.Session::get('categoria_id'))}}"><span class="help-block size-text-1"><br/><br/>Ir al tutorial !!!</span></a>
      </div>
    </div>
    {{--     <p>---<p/> --}}
@endif

</article>

<script type="text/javascript">

</script> 

@stop