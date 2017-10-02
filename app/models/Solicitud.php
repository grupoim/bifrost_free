<?php

class Solicitud extends Eloquent {
	protected $table = 'solicitud';
    public $timestamps = false;

	public function prospectos() {
		return $this->hasMany('Prospectos');
	}

	public function cordinador() {
		return $this->belongsTo('Cordinador');
	}
}