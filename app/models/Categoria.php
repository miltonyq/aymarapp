<?php  

class Categoria extends Eloquent {

	protected $table = 'categorias';
	
	public function seguimientos()
    {
        return $this->hasMany('Seguimiento');
    }

    public function espaoraciones()
    {
        return $this->hasMany('Espaoracione','categoria_id','id');
    }

}

?>