@extends('panel.layouts.base')

@section('content')

<article class="col-xs-12 col-sm-offset-3 col-sm-6 col-sm-offset-3 col-md-offset-3 col-md-6 col-md-offset-3 space_top_3">
    <div class="mdl-card__title">
      <h2 class="title-1"><strong>Notas Obtenidas en cada Categoria</strong></h2><br/>
    </div>
</article>

<article class="col-xs-12 col-sm-offset-3 col-sm-6 col-sm-offset-3 col-md-offset-3 col-md-6 col-md-offset-3 align_center">

{{-- */$count=0;/* --}}
@foreach($seguimientos as $seguimiento)

	<div class="demo-card-event mdl-card mdl-shadow--2dp score" id="score_categoria_{{ $count }}"> 
		<div class="mdl-card__title mdl-card--expand align_center">
				<h3 class="font_1">{{ $seguimiento->categoria()->getResults()->titulo }}</h3>
		</div>
		<div class="mdl-card__title mdl-card--expand align_center">
				<h3>{{ $seguimiento->updated_at }}</h3>
		</div>
		<div class="mdl-card__actions mdl-card--border">
			<span class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect height_card_1">
				<h2>{{ $seguimiento->puntos }}</h2>
			</span>
			<div class="mdl-layout-spacer"></div>

		</div>
	</div>
    {{-- */$count++;/* --}}      
@endforeach
{{-- @for($i=0; $i<$count-1; $i++)

@endfor --}}
</article>
  
<script type="text/javascript">
	$(document).ready(function nuevoTablero(){
		for(var i=0; i<{{ $count }}; i++){
			setCelda(i);
		}
	});

	function setCelda(recuadro){
		var actualRecuadro = "score_categoria_" + recuadro;
		document.getElementById(actualRecuadro).style.backgroundColor = getRandomColor();
	}


	function getRandomColor() {
		var letters = '7689ABCDEF'.split('');
		var color = '#';
		for (var i = 0; i < 6; i++ ) {
			color += letters[Math.floor(Math.random() * 10)];
		}
		return color;
	}
</script>	

@stop