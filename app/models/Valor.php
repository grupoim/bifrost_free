<?php

class Valor extends Eloquent {
	protected $table = 'valor';
	public $timestamps = false;

	public function materialvalor() {
		return $this->hasMany('MaterialValor');
	}
}