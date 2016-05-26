<?php

class Espaoracione extends Eloquent {
	
	protected $table = 'espaoraciones';

    public function categoria()
    {
        return $this->belongsTo('Categoria','categoria_id','id');
    }

    public function aymaoracione()
    {
        return $this->hasOne('Aymaoracione','espaoracione_id','id');
    }
	
}

?>