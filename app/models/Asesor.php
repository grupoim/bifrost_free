<?php

class Asesor extends Eloquent {
	protected $table = 'asesor';
	public $timestamps = false;
	protected $fillable = array('persona_id', 'fecha_ingreso');

	public function comision() {
		return $this->hasMany('Comision');
	}

	public function promotor() { // *** DUDA AQUI *** //
		return $this->hasMany('Promotor', 'promotor_id');
	}

	public function persona() {
		return $this->belongsTo('Persona');
	}
}