<?php

class Puesto extends Eloquent {
	protected $table = 'puesto';

	public function departamento() {
		return $this->belongsTo('departamento');
	}


	
}