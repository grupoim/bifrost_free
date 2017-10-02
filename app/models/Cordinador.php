<?php

class Cordinador extends Eloquent {
	protected $table = 'cordinador';
	public $timestamps = false;

	public function solicitud() {
		return $this->hasMany('Solicitud');
	}
}