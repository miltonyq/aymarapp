<?php

class PersonaController extends BaseController {

	
	public function login_persona()
	{
		
		return View::make('index');

	}

	public function login_persona_post()
	{
		$input = Input::all();
		// $bcrypt = new Bcrypt(15);

		$rules = array(
			'email' => 'required|email|exists:personas,email',
			'password' => 'required',
			);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{
			$email = Input::get('email');
			$password = Input::get('password');

			if($persona = Persona::where('email', '=', $email)->first())
			{
			    if($persona = Persona::where('password', '=', $password)->first())//$bcrypt->verify($password, $persona->password)
				{
				    Session::put('persona_id', $persona->id);
				    Session::put('persona_username', $persona->username);
				    Session::put('persona_email', $persona->email);

				    $seguimiento = DB::table('seguimientos')->where('persona_id', $persona->id)->orderBy('categoria_id', 'desc')->first();
				    
				    Session::put('categoria_id', $seguimiento->categoria_id);

					return Redirect::to('/panel');
				}
				else
				{
					return Redirect::to('/loginpersona');
				}
			}
			else
			{
				return Redirect::to('/loginpersona');
			}

		}
	}

	public function persona_logout()
	{
		Session::flush();
		return Redirect::to('/loginpersona');
	}

	//registro de persona
	public function registro_get()
	{
		if(Persona::isLogged())
		{
			return Redirect::to('/panel');
		}
		else
		{
			return View::make('registrar');
		}
	}
	
	public function registro_post()
	{
		$input = Input::all();
		// $bcrypt = new Bcrypt(15);
		$rules = array(
			'username' => 'required',
			'email' => 'required|email|unique:personas,email',
			'password' => 'required',
			'password2' => 'required|same:password',
			'nombres' => 'required',
			'apellidos' => 'required',
			'edad' => 'required',
			'sexo' => 'required',
			'imagen' => 'mimes:jpeg,bmp,png',
			);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{
			if (Input::hasFile('imagen'))
			{
				$docfile = Input::file('imagen');
				$docext = $docfile->guessClientExtension();
				$docname ='img_'.(time()*12).'_'.(time()*5).'_2.'.$docext;
				$docpath = base_path().'/public/img/persona';
				$docfile->move($docpath,$docname);
				$urlimagen = 'img/persona/'.$docname;

				//$usuario->url_foto = $urlimagen;
			}


			$persona = new Persona;
			$persona->username = Input::get('username');
			$persona->email = Input::get('email');
			// $persona->password = $bcrypt->hash(Input::get('password'));
			$persona->password = Input::get('password');
			$persona->nombres = Input::get('nombres');
			$persona->apellidos = Input::get('apellidos');
			$persona->edad = Input::get('edad');
			$persona->sexo = Input::get('sexo');
			$persona->avatar_src = $urlimagen;
			$persona->save();

			//inicio de seguimiento de persona
	    
	        $seguimiento = new Seguimiento;
			$seguimiento->estado = false;
			$seguimiento->puntos = 0;
			$seguimiento->avance = true;
			$seguimiento->categoria_id = Categoria::find(1)->id;
			$persona->seguimientos()->save($seguimiento);		
   
			//fin de seguimiento de persona

			return Redirect::to('/')->with('registro', 'Registro completado. Accede a su cuenta');
		}
	}

}
