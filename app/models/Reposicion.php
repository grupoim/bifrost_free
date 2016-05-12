<?php

class Reposicion extends Eloquent {
	protected $table = 'reposicion';
	

	
	public function materialbaja() {
		return $this->hasMany('MaterialBaja');
	}
	
}