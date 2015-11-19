<?php

class Panteon extends Eloquent {
	protected $table = 'panteon';
	public $timestamps = false;

	public function panteonventaexhumacion() {
		return $this->hasMany('PanteonVentaExhumacion');
	}
}