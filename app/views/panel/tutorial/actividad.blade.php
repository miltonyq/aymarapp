@extends('panel.layouts.base')

@section('content')

<article class="col-xs-12 col-sm-offset-3 col-sm-6 col-sm-offset-3 col-md-offset-3 col-md-6 col-md-offset-3 space_top_3">
  <div class="mdl-card__title">
    <h2 class="title-1">{{-- # {{ $categoria->id }}:  --}}{{ $categoria->titulo }} <br /><strong>Actividad</strong></h2><br/>
  </div>
</article>

<article class="col-xs-12 col-sm-offset-3 col-sm-6 col-sm-offset-3 col-md-offset-3 col-md-6 col-md-offset-3">
  {{Form::open(array('method' => 'POST', 'url' => '/panel/tutorial/actividad/'.$categoria->id, 'role' => 'form'))}}
  
  @for ($i=0; $i < 8; $i++)
  @if($i != 0)
  <div class="hide" id="pregunta_{{ $i }}">
  <div class="demo-card-wide mdl-card mdl-shadow--2dp">
    <div class="container-2 color-text-1 padding-top-20 padding-box-1">

      <span class="mdl-card__title-text align_center">{{ $pregs[$i]['espaoracione_1']->aymaoracione()->getResults()->oracion }}</span>
      <audio id="miSonido_{{ $i }}_{{ $pregs[$i]['espaoracione_1']->aymaoracione()->getResults()->id }}" src="{{ asset($pregs[$i]['espaoracione_1']->aymaoracione()->getResults()->audio_src) }}"></audio>
      <p class='audio_2' onmouseover="PlaySound('miSonido_{{ $i }}_{{ $pregs[$i]['espaoracione_1']->aymaoracione()->getResults()->id }}')" onmouseout="StopSound('miSonido_{{ $i }}_{{ $pregs[$i]['espaoracione_1']->aymaoracione()->getResults()->id }}')">
        <img src='{{ URL::asset("img/otros/speaker.png") }}' width="30" height="30"/>
      </p>
      <p>
        <img src="{{ asset($pregs[$i]['espaoracione_1']->aymaoracione()->getResults()->imagen_src) }}" width="100" height="100" style="display: block; margin: 0 auto;" class="thumbnail">
      </p>


      <div class="form-group">
        {{Form::hidden('espaoracione_id_'.$i, $pregs[$i]['espaoracione_1']->id, array('class' => 'form-control'))}}
        <span class="help-block">{{ $errors->first('espaoracione_id_'.$i) }}</span>
      </div>

      <div>
        {{-- */$j=0;/* --}}
        @foreach($pregs[$i]['rand_espaoraciones'] as $rand_espaoracione)

        <article class="col-xs-6 col-sm-6 col-md-6">
          <div class="mdl-card__supporting-text-1">
            {{Form::label($rand_espaoracione->oracion, false, array('class' => 'txtComparacion'))}}
          </div>
          {{Form::radio('id_espa_res_'.$i, $rand_espaoracione->id, false, array('id' => 'id_espa_res_'.$i.'_'.$j,'class' => 'form-control', 'onclick'=>'add_evaluacion('.$i.')'))}}
        </article>

        {{-- */$j++;/* --}}
        @endforeach
      </div> 
    </div> 
    </div><br/>
    <div class="">
      <a class="button_prev" id='preg_prev_{{ $i }}'>
        <i class="material-icons">arrow_back</i>
      </a>
      <a class="button_next" id='preg_next_{{ $i }}'>
        <i class="material-icons">arrow_forward</i>
      </a>
    </div>
  </div>
  @else
  <div id="pregunta_{{ $i }}">
  <div class="demo-card-wide mdl-card mdl-shadow--2dp">
    <div class="container-2 color-text-1 padding-top-20 padding-box-1">

      <span class="mdl-card__title-text align_center">{{ $pregs[$i]['espaoracione_1']->aymaoracione()->getResults()->oracion }}</span>
      <audio id="miSonido_{{ $i }}_{{ $pregs[$i]['espaoracione_1']->aymaoracione()->getResults()->id }}" src="{{ asset($pregs[$i]['espaoracione_1']->aymaoracione()->getResults()->audio_src) }}"></audio>
      <p class='audio_2' onmouseover="PlaySound('miSonido_{{ $i }}_{{ $pregs[$i]['espaoracione_1']->aymaoracione()->getResults()->id }}')" onmouseout="StopSound('miSonido_{{ $i }}_{{ $pregs[$i]['espaoracione_1']->aymaoracione()->getResults()->id }}')">
        <img src='{{ URL::asset("img/otros/speaker.png") }}' width="30" height="30"/>
      </p>
      <p>
        <img src="{{ asset($pregs[$i]['espaoracione_1']->aymaoracione()->getResults()->imagen_src) }}" width="100" height="100" style="display: block; margin: 0 auto;" class="thumbnail">
      </p>


      <div class="form-group">
        {{Form::hidden('espaoracione_id_'.$i, $pregs[$i]['espaoracione_1']->id, array('class' => 'form-control'))}}
        <span class="help-block">{{ $errors->first('espaoracione_id_'.$i) }}</span>
      </div>

      <div>
        {{-- */$j=0;/* --}}
        @foreach($pregs[$i]['rand_espaoraciones'] as $rand_espaoracione)

        <article class="col-xs-6 col-sm-6 col-md-6">
          <div class="mdl-card__supporting-text-1">
            {{Form::label($rand_espaoracione->oracion, false, array('class' => 'txtComparacion'))}}
          </div>
          {{Form::radio('id_espa_res_'.$i, $rand_espaoracione->id, false, array('id' => 'id_espa_res_'.$i.'_'.$j,'class' => 'form-control', 'onclick'=>'add_evaluacion('.$i.')'))}}
        </article>

        {{-- */$j++;/* --}}
        @endforeach
      </div> 
    </div>
    </div><br/>
    <div class="">
    <a class="button_next" id='preg_next_{{ $i }}'>
      <i class="material-icons">arrow_forward</i>
    </a>
    </div>
  </div>
  @endif
  @endfor
  <div class="form-group hide margin-top-_30" id="btn_evaluar">
    <p>{{Form::submit('Evaluar', array('class' => 'btn btn-primary btn button_2_sc'))}}</p>
  </div>
  {{Form::close()}}
  
</article>
<script type="text/javascript">
  $(document).ready(function(){
    var cadena = $('.txtComparacion').text();
    separador = "",
    arregloDeSubCadenas = cadena.split(separador);
    if(arregloDeSubCadenas.length > 13){
      $(".mdl-card__supporting-text-1").css("font-size", "12px");
    }
  });
</script>

<script type="text/javascript">
  $('#preg_next_0').click(function(){
    $('#pregunta_0').removeClass('show');
    $('#pregunta_0').addClass('hide');
    $('#pregunta_1').addClass('show');
  });
  $('#preg_prev_1').click(function(){
    $('#pregunta_1').removeClass('show');
    $('#pregunta_1').addClass('hide');
    $('#pregunta_0').addClass('show');
  });
  $('#preg_next_1').click(function(){
    $('#pregunta_1').removeClass('show');
    $('#pregunta_1').addClass('hide');
    $('#pregunta_2').addClass('show');
  });
  $('#preg_prev_2').click(function(){
    $('#pregunta_2').removeClass('show');
    $('#pregunta_2').addClass('hide');
    $('#pregunta_1').addClass('show');
  });
  $('#preg_next_2').click(function(){
    $('#pregunta_2').removeClass('show');
    $('#pregunta_2').addClass('hide');
    $('#pregunta_3').addClass('show');
  });
  $('#preg_prev_3').click(function(){
    $('#pregunta_3').removeClass('show');
    $('#pregunta_3').addClass('hide');
    $('#pregunta_2').addClass('show');
  });
  $('#preg_next_3').click(function(){
    $('#pregunta_3').removeClass('show');
    $('#pregunta_3').addClass('hide');
    $('#pregunta_4').addClass('show');
  });
  $('#preg_prev_4').click(function(){
    $('#pregunta_4').removeClass('show');
    $('#pregunta_4').addClass('hide');
    $('#pregunta_3').addClass('show');
  });
  $('#preg_next_4').click(function(){
    $('#pregunta_4').removeClass('show');
    $('#pregunta_4').addClass('hide');
    $('#pregunta_5').addClass('show');
  });
  $('#preg_prev_5').click(function(){
    $('#pregunta_5').removeClass('show');
    $('#pregunta_5').addClass('hide');
    $('#pregunta_4').addClass('show');
  });
  $('#preg_next_5').click(function(){
    $('#pregunta_5').removeClass('show');
    $('#pregunta_5').addClass('hide');
    $('#pregunta_6').addClass('show');
  });
  $('#preg_prev_6').click(function(){
    $('#pregunta_6').removeClass('show');
    $('#pregunta_6').addClass('hide');
    $('#pregunta_5').addClass('show');
  });
  $('#preg_next_6').click(function(){
    $('#pregunta_6').removeClass('show');
    $('#pregunta_6').addClass('hide');
    $('#pregunta_7').addClass('show');
  });
  $('#preg_next_6').click(function(){
    $('#preg_next_7').addClass('hide');
    $('#btn_evaluar').removeClass('hide');
    $('#btn_evaluar').addClass('show');
  });
  $('#preg_prev_7').click(function(){
    $('#pregunta_7').removeClass('show');
    $('#pregunta_7').addClass('hide');
    $('#pregunta_6').addClass('show');
    $('#btn_evaluar').removeClass('show');
    $('#btn_evaluar').addClass('hide');
  });
</script>

<script type="text/javascript">
  function add_evaluacion(i){
    if($("input[name='id_espa_res_"+i+"']").is(":checked")){
      // console.log(i);
      return true;
    }
    return false;
  }
</script>

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