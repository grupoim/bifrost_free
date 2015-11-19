<?php

class Accion extends Eloquent {
	protected $table = 'accion';
	public $timestamps = false;

	public function movimiento() {
		return $this->hasMany('Movimiento');
	}
}