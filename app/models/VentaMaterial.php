<?php

class VentaMaterial extends Eloquent {
	protected $table = 'venta_material';	

	
	public function materialbaja() {
		return $this->hasMany('MaterialBaja');
	}
	
}