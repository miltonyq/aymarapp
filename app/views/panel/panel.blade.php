@extends('panel.layouts.base')

@section('content')

<article class="col-xs-12 col-sm-offset-1 col-sm-10 col-sm-offset-1 col-md-offset-1 col-md-10 col-md-offset-1 space_top_3">
	<div class="mdl-card__title">
        <h2 class="title-1">Bienvenido {{Session::get('persona_username')}}</h2><br/>
    </div>
    
</article>
<article class="col-xs-12 col-sm-offset-3 col-sm-6 col-sm-offset-3 col-md-offset-3 col-md-6 col-md-offset-3 cuadro-content">
	<div class="demo-card-wide mdl-card mdl-shadow--2dp form-signin-3">
		<img src="{{URL::asset('/img/aymarapp.jpg')}}" alt="Habla aymara" class="image-tuto_3" />
	</div>
</article>
<article class="col-xs-12 col-sm-offset-1 col-sm-10 col-sm-offset-1 col-md-offset-1 col-md-10 col-md-offset-1">
	<div class="mdl-card__supporting-text title-3">
		<br/>La siguiente aplicación está dirigida al apoyo en la enseñanza del Idioma Nativo Aymara, en el cual encontraras un diccionario español – Aymara o Aymara Español con imágenes y audios. Además las frases más utilizadas que cada Servidor Público del Estado necesita saber para una mejor interacción con las personas del área rural y finalmente la evaluación de dichas frases más utilizadas apoyadas de audios e imágenes.
	</div>
</article>
@stop