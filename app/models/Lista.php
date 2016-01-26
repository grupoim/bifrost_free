<?php

class Lista extends Eloquent {
	protected $table = 'lista';
	public $timestamps = false;

	public function asistencia() {
		return $this->hasMany('Asistencia');
	}

	
}