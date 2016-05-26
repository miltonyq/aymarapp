<div class="block">


<div class="block">
	<h3>Acceso de Usuario</h3>
	@if(!Session::has('user_id'))
        <ul>
            <li><a href="{{URL::to('/loginusuario')}}">Acceder</a></li>
            {{--<li><a href="{{URL::to('/signup')}}">Registrarse</a></li>--}}
        </ul>
    @else
        <p>¡Hola {{Session::get('user_username')}}!</p>
        <p><a href="{{URL::to('/administrador')}}">Panel de Administracion</a></p>
        <p><a href="{{URL::to('/usuariologout')}}">¿Salir?</a></p>
    @endif
</div>