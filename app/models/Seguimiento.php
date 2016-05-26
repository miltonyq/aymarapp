<?php  

class Seguimiento extends Eloquent {

	protected $table = 'seguimientos';
	
	public function persona()
    {
        return $this->belongsTo('Persona');
    }

    public function categoria()
    {
        return $this->belongsTo('Categoria');
    }
}

?>