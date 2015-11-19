<?php

class Colonia extends Eloquent {
	protected $table = 'colonia';
	public $timestamps = false;

	public function municipio() {
		return $this->belongsTo('Municipio');
	}

	public function cliente() {
		return $this->hasMany('Cliente');
	}
}