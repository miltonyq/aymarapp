@extends('admin.layouts.base')

@section('content')
<article class="col-xs-12 col-sm-offset-3 col-sm-6 col-sm-offset-3 col-md-offset-2 col-md-8 col-md-offset-2">
	<div class="mdl-card__title">
        <h2 class="title-1">Administrador</h2>
    </div>
	
	<div class="mdl-card__title">
        <h2 class="title-1">{{Session::get('user_username')}} !!! </h2>
    </div>

	<div class="mdl-card__title">
        <h2 class="title-1">Bienvenido(a), al tutor inteligente !!! </h2>
    </div>
	
</article>
@stop