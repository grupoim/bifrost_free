<?php

class Pago extends Eloquent {
	protected $table = 'pago';

	public function formapago() {
		return $this->belongsTo('FormaPago');
	}

	public function recibo() {
		return $this->belongsTo('Recibo');
	}
}