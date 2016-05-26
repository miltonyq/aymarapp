<?php

class Aymaoracione extends Eloquent {
	
	protected $table = 'aymaoraciones';

	public function espaoracione()
    {
        return $this->belongsTo('Espaoracione','espaoracione_id','id');
    }

}

?>