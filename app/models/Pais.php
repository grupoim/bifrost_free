<?php

class Pais extends Eloquent {
	protected $table = 'pais';
	public $timestamps = false;

	public function estado() {
		return $this->hasMany('Estado');
	}
}