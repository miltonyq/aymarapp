<?php

class AdminController extends BaseController {


	public function admin_home()
	{
		return View::make('admin.panel_administrador');
	}

    //Inicio administracion de personas
	
	public function personas()
	{
		$personas = Persona::all();
		return View::make('admin.personas.personas')->with('personas', $personas);
	}

	public function personas_add()
	{
		$input = Input::all();
		$bcrypt = new Bcrypt(15);
		$rules = array(
			'username' => 'required',
			'email' => 'required|email|unique:personas,email',
			'password' => 'required',
			'password2' => 'required|same:password',
			'nombres' => 'required',
			'apellidos' => 'required',
			'edad' => 'required',
			'sexo' => 'required',
			//'avatar_src' => 'required',
			);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{
			$persona = new Persona;
			$persona->username = Input::get('username');
			$persona->email = Input::get('email');
			$persona->password = $bcrypt->hash(Input::get('password'));
			$persona->nombres = Input::get('nombres');
			$persona->apellidos = Input::get('apellidos');
			$persona->edad = Input::get('edad');
			$persona->sexo = Input::get('sexo');
			$persona->avatar_src = "img/persona/perfil_default.jpg";
			$persona->save();

			//inicio de seguimiento de persona
	    
	        $seguimiento = new Seguimiento;
			$seguimiento->estado = false;
			$seguimiento->puntos = 0;
			$seguimiento->avance = true;
			$seguimiento->categoria_id = Categoria::find(1)->id;
			$persona->seguimientos()->save($seguimiento);		
   
			//fin de seguimiento de persona

			return Redirect::to('/administrador/personas');
		}
	}

	public function personas_get_edit($id)
	{
		$personas = Persona::all();
		$persona = Persona::find($id);
		return View::make('admin.personas.personas')->with('personas', $personas)->with('persona', $persona);
	}

	public function personas_post_edit($id)
	{
		$input = Input::all();

		$rules = array(
			'username' => 'required',
			'email' => 'required|email|unique:personas,email',
			/*'password' => 'required',*/
			'nombres' => 'required',
			'apellidos' => 'required',
			'edad' => 'required',
			'sexo' => 'required',
			//'avatar_src' => 'required',
			);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{    
			
			$persona = Persona::find($id);
			$persona->username = Input::get('username');
			$persona->email = Input::get('email');
			/*$persona->password = Input::get('password');*/
			$persona->nombres = Input::get('nombres');
			$persona->apellidos = Input::get('apellidos');
			$persona->edad = Input::get('edad');
			$persona->sexo = Input::get('sexo');
			//$persona->avatar_src = Input::get('avatar_src');
			$student->save();

			return Redirect::to('/administrador/personas');
		}
	}

	public function personas_delete($id)
	{
		$persona = Persona::find($id);
		$persona->delete();
		return Redirect::to('/administrador/personas');
	}

    //Fin administracion de personas
    

    //Inicio administrador de diccionario
    
    public function nueva_palabra_get()
	{
		$espapals = Espapal::all();
		return View::make('admin.diccionario.palabra')->with('espapals', $espapals);
	}
    
    public function nueva_palabra_add()
	{
		$input = Input::all();
		$rules = array(
			'palabra_esp' => 'required|unique:espapals,palabra',
			'palabra_aym' => 'required|unique:aymapals,palabra',
			'imagen' => 'required|mimes:jpeg,bmp,png',	
			'audio' => 'required|mimes:mpga',
			);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{
			$docfile = Input::file('imagen');
			$docext = $docfile->guessClientExtension();
			$docname ='img_'.(time()*12).'_'.(time()*5).'_2.'.$docext;
			$docpath = base_path().'/public/img/aymara';
			$docfile->move($docpath,$docname);
			$urlimagen = 'img/aymara/'.$docname;

			$docfile = Input::file('audio');
			$docext = $docfile->guessClientExtension();
			$docname ='img_'.(time()*12).'_'.(time()*5).'_2.'.'mp3';
			$docpath = base_path().'/public/media/audio';
			$docfile->move($docpath,$docname);
			$urlaudio = 'media/audio/'.$docname;

			$espapal = new Espapal;
			$espapal->palabra = Input::get('palabra_esp');
			$espapal->save();

			$aymapal = new Aymapal;
			$aymapal->palabra = Input::get('palabra_aym');
			$aymapal->audio_src = $urlaudio;
			$aymapal->imagen_src = $urlimagen;
			$espapal->aymapal()->save($aymapal);

			return Redirect::to('/administrador/nueva_palabra/get');
		}
		
	}

   
	public function palabra_get_edit($id)
	{
		$espapals = Espapal::all();
		$espapal = Espapal::find($id);

		return View::make('admin.diccionario.palabra')->with('espapals', $espapals)->with('espapal', $espapal);
	}

	public function palabra_post_edit($id)
	{ 
		$input = Input::all();
		$rules = array(
			'palabra_esp' => 'required',
			'palabra_aym' => 'required',
			'imagen' => 'mimes:jpeg,bmp,png',	
			'audio' => 'mimes:mpga',
			
			);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{ 
			$espapal = Espapal::find($id);
            $aymapal = $espapal->aymapal()->getResults();

			$urlimagen = null;
			$urlaudio = null;

			if (Input::hasFile('imagen'))
			{
				$docfile = Input::file('imagen');
				$docext = $docfile->guessClientExtension();
				$docname ='img_'.(time()*12).'_'.(time()*5).'_2.'.$docext;
				$docpath = base_path().'/public/img/aymara';
				$docfile->move($docpath,$docname);
				$urlimagen = 'img/aymara/'.$docname;

			}
			else
			{
				$urlimagen = $aymapal->imagen_src;
			}

			if (Input::hasFile('audio'))
			{
				$docfile = Input::file('audio');
				$docext = $docfile->guessClientExtension();
				$docname ='img_'.(time()*12).'_'.(time()*5).'_2.'.'mp3';
				$docpath = base_path().'/public/media/audio';
				$docfile->move($docpath,$docname);
				$urlaudio = 'media/audio/'.$docname;

			}
			else
			{
				$urlaudio = $aymapal->audio_src;
			}

			$espapal->palabra = Input::get('palabra_esp');
            $espapal->save();

			$aymapal->palabra = Input::get('palabra_aym');
            $aymapal->imagen_src = $urlimagen;
            $aymapal->audio_src = $urlaudio;
            $aymapal->save();
		
			return Redirect::to('/administrador/palabra/edit/'.$id);
		}

	}

	public function palabra_delete($id)
	{
		$espapal = Espapal::find($id);
		$espapal->delete();
		return Redirect::to('/administrador/nueva_palabra/get');
	}
   
    //Fin administrador de diccionario
    
    //Inicio administrador de Categoria y Oraciones
    
    public function categorias()
	{
		$categorias = Categoria::all();
		return View::make('admin.tutorial.categorias')->with('categorias', $categorias);
	}

	public function categorias_add()
	{
		$input = Input::all();
		$rules = array(
			'titulo' => 'required',
			
			);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{
			$categoria = new Categoria;
			$categoria->titulo = Input::get('titulo');
			$categoria->save();

			return Redirect::to('/administrador/categorias');
		}
	}

	public function categorias_get_edit($id)
	{
		$categorias = Categoria::all();
		$categoria = Categoria::find($id);
		return View::make('admin.tutorial.categorias')->with('categorias', $categorias)->with('categoria', $categoria);
	}

	public function categorias_post_edit($id)
	{
		$input = Input::all();

		$rules = array(
			'titulo' => 'required',

			);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{    
			
			$categoria = Categoria::find($id);
			$categoria->titulo = Input::get('titulo');
			$categoria->save();

			return Redirect::to('/administrador/categorias/edit/'.$id);
		}
	}

	public function categorias_delete($id)
	{
		$categoria = Categoria::find($id);
		$categoria->delete();
		return Redirect::to('/administrador/categorias');
	}


	//Oraciones
	
	public function oraciones($id_cat)
	{
		$categoria = Categoria::find($id_cat);
        $espaoraciones = $categoria->espaoraciones()->getResults();

		return View::make('admin.tutorial.oraciones')->with('espaoraciones', $espaoraciones)->with('categoria', $categoria);
	}
	
	public function oraciones_add($id_cat)
	{
		$input = Input::all();
		$rules = array(
			'oracion_esp' => 'required',
			'oracion_aym' => 'required',
			'imagen' => 'required|mimes:jpeg,bmp,png',	
			'audio' => 'required|mimes:mpga',
			
			);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{
            $categoria = Categoria::find($id_cat);

			$docfile = Input::file('imagen');
			$docext = $docfile->guessClientExtension();
			$docname ='img_'.(time()*12).'_'.(time()*5).'_2.'.$docext;
			$docpath = base_path().'/public/img/aymara';
			$docfile->move($docpath,$docname);
			$urlimagen = 'img/aymara/'.$docname;

			$docfile = Input::file('audio');
			$docext = $docfile->guessClientExtension();
			$docname ='img_'.(time()*12).'_'.(time()*5).'_2.'.'mp3';
			$docpath = base_path().'/public/media/audio';
			$docfile->move($docpath,$docname);
			$urlaudio = 'media/audio/'.$docname;

			$espaoracione = new Espaoracione;
			$espaoracione->oracion = Input::get('oracion_esp');
			$categoria->espaoraciones()->save($espaoracione);

			$aymaoracione = new Aymaoracione;
			$aymaoracione->oracion = Input::get('oracion_aym');
            $aymaoracione->imagen_src = $urlimagen;
            $aymaoracione->audio_src = $urlaudio;
            $espaoracione->aymaoracione()->save($aymaoracione);

			return Redirect::to('/administrador/categorias/oraciones/'.$id_cat);
		}
	}
	
    public function oraciones_get_edit($id_cat, $id)
	{
		$categoria = Categoria::find($id_cat);
        $espaoraciones = $categoria->espaoraciones()->getResults();
        $espaoracione = Espaoracione::find($id);

		return View::make('admin.tutorial.oraciones')->with('espaoraciones', $espaoraciones)->with('categoria', $categoria)->with('espaoracione', $espaoracione);
	}
	
	public function oraciones_post_edit($id_cat, $id)
	{ 
		$input = Input::all();
		$rules = array(
			'oracion_esp' => 'required',
			'oracion_aym' => 'required',
			'imagen' => 'mimes:jpeg,bmp,png',	
			'audio' => 'mimes:mpga',
			
			);

		$validator = Validator::make($input, $rules);

		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator);
		}
		else
		{ 
			$categoria = Categoria::find($id_cat);
			$espaoracione = Espaoracione::find($id);
            $aymaoracione = $espaoracione->aymaoracione()->getResults();

			$urlimagen = null;
			$urlaudio = null;

			if (Input::hasFile('imagen'))
			{
				$docfile = Input::file('imagen');
				$docext = $docfile->guessClientExtension();
				$docname ='img_'.(time()*12).'_'.(time()*5).'_2.'.$docext;
				$docpath = base_path().'/public/img/aymara';
				$docfile->move($docpath,$docname);
				$urlimagen = 'img/aymara/'.$docname;

			}
			else
			{
				$urlimagen = $aymaoracione->imagen_src;
			}

			if (Input::hasFile('audio'))
			{
				$docfile = Input::file('audio');
				$docext = $docfile->guessClientExtension();
				$docname ='img_'.(time()*12).'_'.(time()*5).'_2.'.'mp3';
				$docpath = base_path().'/public/media/audio';
				$docfile->move($docpath,$docname);
				$urlaudio = 'media/audio/'.$docname;

			}
			else
			{
				$urlaudio = $aymaoracione->audio_src;
			}

			$espaoracione->oracion = Input::get('oracion_esp');
            $espaoracione->save();

			$aymaoracione->oracion = Input::get('oracion_aym');
            $aymaoracione->imagen_src = $urlimagen;
            $aymaoracione->audio_src = $urlaudio;
            $aymaoracione->save();
		
			return Redirect::to('/administrador/categorias/oraciones/'.$id_cat.'/edit/'.$id);
		}

	}
	
    public function oraciones_delete($id_cat, $id)
	{
		$espaoracione = Espaoracione::find($id);
		$espaoracione->delete();
		return Redirect::to('/administrador/categorias/oraciones/'.$id_cat);
	}

    //Fin administrador de Categoria y Oraciones
}