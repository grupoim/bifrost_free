<?php

class FormaPago extends Eloquent {
	protected $table = 'forma_pago';
	public $timestamps = false;

	public function pago() {
		return $this->hasMany('Pago');
	}
}