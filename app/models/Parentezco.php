<?php

class Parentezco extends Eloquent {
	protected $table = 'parentezco';
	public $timestamps = false;

	public function testigodeinhumado() {
		return $this->hasMany('TestigoDeInhumado');
	}
}