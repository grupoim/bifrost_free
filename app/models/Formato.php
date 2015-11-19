<?php

class Formato extends Eloquent {
	protected $table = 'formato';

	public function contrato() {
		return $this->hasMany('Contrato');
	}
}