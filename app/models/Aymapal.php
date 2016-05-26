<?php

class Aymapal extends Eloquent {
	
	protected $table = 'aymapals';
	
	public function espapal()
    {
    	return $this->belongsTo('Espapal','espapal_id','id');
    }
	
}

?>