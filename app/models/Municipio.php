<?php

class Municipio extends Eloquent {
	protected $table = 'municipio';
	public $timestamps = false;

	public function estado() {
		return $this->belongsTo('Estado');
	}

	public function colonia() {
		return $this->hasMany('Colonia');
	}

	public function Empresa() {
		return $this->hasMany('Empresa');
	}
}