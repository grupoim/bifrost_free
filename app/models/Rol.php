<?php

class Rol extends Eloquent {
	protected $table = 'rol';
	public $timestamps = false;

	public function usuario() {
		return $this->hasMany('Usuario');
	}
}