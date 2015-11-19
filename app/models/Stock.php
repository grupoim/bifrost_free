<?php

class Stock extends Eloquent {
	protected $table = 'stock';	

	
	public function materialbaja() {
		return $this->hasMany('MaterialBaja');
	}
	
}