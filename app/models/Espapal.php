<?php  

class Espapal extends Eloquent {

	protected $table = 'espapals';
	
    public function aymapal()
    {
    	return $this->hasOne('Aymapal','espapal_id','id');
    }

}

?>