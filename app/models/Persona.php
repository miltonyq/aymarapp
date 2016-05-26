<?php

class Persona extends Eloquent {
	
	protected $table = 'personas';

	public function seguimientos()
    {
        return $this->hasMany('Seguimiento');
    }
	
	//para saber si esta logueado
	
	public static function isLogged()
	{
		if(Session::has('persona_id'))
			return true;
		else
			return false;
	}
}

?>