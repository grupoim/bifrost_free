<?php

class Etapa extends Eloquent {
	protected $table = 'etapa';
	public $timestamps = false;

	public function estatus() {
		return $this->hasMany('Estatus');
	}
}