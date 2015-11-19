<?php

class Rubro extends Eloquent {
	protected $table = 'rubro';
	public $timestamps = false;

	public function departamento() {
		return $this->belongsTo('Departamento');
	}

	public function queja() {
		return $this->hasMany('Queja');
	}
}