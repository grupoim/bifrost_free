<?php

class CausaDefuncion extends Eloquent {
	protected $table = 'causa_defuncion';
	public $timestamps = false;

	public function inhumado() {
		return $this->hasMany('Inhumado');
	}
}