<?php

class PanelController extends BaseController {

	public function panel()
	{
		$persona = Persona::find(Session::get('persona_id'));

		
		return View::make('panel.panel');
	}

    //Inicio Diccionario
	public function busca_trad_get()
	{
		$objpalabras = null;
		$tipo = null;

		if (Input::has('palabra') && Input::has('tipo'))
		{
			$input = Input::all();

			$rules = array(
				'palabra' => 'required|regex:/(^[ñÑA-Za-z0-9 ]+$)+/',
				'tipo' => 'required',
				);

			$validator = Validator::make($input, $rules);

			if($validator->fails())
			{
				return Redirect::back()->withErrors($validator);
			}
			else
			{
				$palabra = Input::get('palabra');
				$tipo = Input::get('tipo');
				if($tipo == 1)
				{
					$objpalabras = Espapal::where('palabra', 'LIKE', '%'.$palabra.'%')->get(); 

				}
				else
				{
					$objpalabras = Aymapal::where('palabra', 'LIKE', '%'.$palabra.'%')->get();
				}

			}
		}

		return View::make('panel.diccionario.diccionario')->with('objpalabras', $objpalabras)->with('tipo',$tipo);
	}

	public function search_ajax()
	{
		$tipo = Input::get('tipo');
		$palabra = Input::get('palabra');

        $hits = null;

		if($tipo == 1)
		{
			$registrados = Espapal::where('palabra', 'LIKE', '%'.$palabra.'%')->orderBy('palabra', 'asc')->get();
			foreach ($registrados as $registrado) {
				$hits[] = array('palabra' => $registrado->toArray(), 'traduccion' =>$registrado->aymapal()->getResults()->toArray() );
			}
		}
		else
		{
			$registrados = Aymapal::where('palabra', 'LIKE', '%'.$palabra.'%')->orderBy('palabra', 'asc')->get();
			foreach ($registrados as $registrado) {
				$hits[] = array('palabra' => $registrado->toArray(), 'traduccion' =>$registrado->espapal()->getResults()->toArray() );
			}
		}

		return Response::json(array('hits' => $hits,'tipo' => $tipo));

	}

	public function tipo_ajax()
	{
		$tipo = Input::get('tipo');

        $hits = null;

		if($tipo == 1)
		{
			$registrados = Espapal::orderBy('palabra', 'asc')->get();
			foreach ($registrados as $registrado) {
				$hits[] = array('palabra' => $registrado->toArray(), 'traduccion' =>$registrado->aymapal()->getResults()->toArray() );
			}
		}
		else
		{
			$registrados = Aymapal::orderBy('palabra', 'asc')->get();
			foreach ($registrados as $registrado) {
				$hits[] = array('palabra' => $registrado->toArray(), 'traduccion' =>$registrado->espapal()->getResults()->toArray() );
			}
		}

       //'registrados' => $registrados->toArray(),'tipo' => $tipo,

		return Response::json(array('hits' => $hits,'tipo' => $tipo));

	}
	//Fin Diccionario
    
    //Inicio tutorial - actividad
    
    public function tutorial_categoria($cat_id)
	{
		$categoria = Categoria::find($cat_id);
		$espaoraciones = $categoria->espaoraciones()->getResults();

		$seguimientos = Seguimiento::where('persona_id', '=', Session::get('persona_id'))->orderBy('categoria_id', 'asc')->get();
        
		return View::make('panel.tutorial.categoria')->with('categoria', $categoria)->with('seguimientos', $seguimientos)->with('espaoraciones', $espaoraciones);
	}

	public function tutorial_actividad($cat_id)
	{
		$categoria = Categoria::find($cat_id);
		$espaoraciones = $categoria->espaoraciones()->getResults();

		$pregs = null;

		for ($i = 0; $i < 8; $i++) {
			//esto es para actividad 
			$rand_espaoraciones = Espaoracione::where('categoria_id', '=',$categoria->id)->orderBy(DB::raw('RAND()'))->take(2)->get();
			$espaoracione_1 = $rand_espaoraciones->random(1);
			$pregs[] = array('rand_espaoraciones' => $rand_espaoraciones, 'espaoracione_1' =>$espaoracione_1 );
		}

		$seguimientos = Seguimiento::where('persona_id', '=', Session::get('persona_id'))->orderBy('categoria_id', 'asc')->get();
        
		return View::make('panel.tutorial.actividad')->with('categoria', $categoria)->with('seguimientos', $seguimientos)->with('espaoraciones', $espaoraciones)->with('pregs',$pregs);
	}
	
	public function tutorial_actividad_post($cat_id)
	{
        $persona = Persona::find(Session::get('persona_id'));

		$input = Input::all();

		$ora_corr_id = "espaoracione_id_";
		$ora_sele_id = "id_espa_res_";

        $puntos = 0;
        $aprob = false;
		$terminado = false;

		for ($i = 0; $i < 8; $i++) {

			$id_corr = $ora_corr_id.$i;
			$id_sele = $ora_sele_id.$i;

			$espaoracione_1 = Input::get($id_corr);
			$espaoracione_2 = Input::get($id_sele);

            if($espaoracione_1 == $espaoracione_2)
            {
            	$puntos = $puntos + 10;
            }

		}

		$seguimiento_act = Seguimiento::where('persona_id', '=', $persona->id)->where('categoria_id', '=', $cat_id)->first();

		if($puntos >= 60)
		{
			
			$aprob = true;
  
			if(($seguimiento_act->estado == true) && ($seguimiento_act->avance == false))
			{
				if($puntos > $seguimiento_act->puntos)
				{
					$seguimiento_act->puntos = $puntos;
					$seguimiento_act->save();
				}

			}
			else
			{
			$seguimiento_ant_table = DB::table('seguimientos')->where('persona_id', $persona->id)->orderBy('categoria_id', 'desc')->first();

			$seguimiento_ant = Seguimiento::find($seguimiento_ant_table->id);
			$seguimiento_ant->estado = true;
			$seguimiento_ant->puntos = $puntos;
			$seguimiento_ant->avance = false;
			$seguimiento_ant->save();

			//inicio de paso a siguiente categoria

			$sig_id = Categoria::where('id', '>', $cat_id)->min('id');

			if($sig_id != null)
			{
				$seguimiento_sig = new Seguimiento;
				$seguimiento_sig->estado = false;
				$seguimiento_sig->puntos = 0;
				$seguimiento_sig->avance = true;
				$seguimiento_sig->categoria_id = $sig_id;
				$persona->seguimientos()->save($seguimiento_sig);	

				Session::put('categoria_id', $seguimiento_sig->categoria_id);	
			}
			else
			{
				$terminado = true;      
			}
			//fin paso a siguiente categoria

			}


			

		} 



		return Redirect::to('/panel/tutorial/actividad_evaluar/'.$cat_id)->with('aprob',$aprob)->with('puntos',$puntos)->with('terminado',$terminado);
		
	}
    
	public function tutorial_actividad_evaluar($cat_id)
	{
		$categoria = Categoria::find($cat_id);
		$espaoraciones = $categoria->espaoraciones()->getResults();

		$seguimientos = Seguimiento::where('persona_id', '=', Session::get('persona_id'))->orderBy('categoria_id', 'asc')->get();

		return View::make('panel.tutorial.actividad_evaluar')->with('categoria', $categoria)->with('seguimientos', $seguimientos)->with('espaoraciones', $espaoraciones);
	}

    //Fin tutorial - actividad
    
    //Inicio notas
    

    public function categoria_notas()
	{
		$persona = Persona::find(Session::get('persona_id'));

		$seguimientos = Seguimiento::where('persona_id', '=', $persona->id)->orderBy('categoria_id', 'asc')->get();
		return View::make('panel.tutorial.categoria_notas')->with('seguimientos', $seguimientos);
	}
    //Fin notas

}
