<?php

class EstadoCivil extends Eloquent {
	protected $table = 'estado_civil';
	public $timestamps = false;

	public function cliente() {
		return $this->hasMany('Cliente');
	}
}