<?php

class Estado extends Eloquent {
	protected $table = 'estado';
	public $timestamps = false;

	public function pais() {
		return $this->belongsTo('Pais');
	}

	public function municipio() {
		return $this->hasMany('Municipio');
	}
}