<?php

class Evento extends Eloquent {
	protected $table = 'evento';
	public $timestamps = false;

	public function movimiento() {
		return $this->belongsTo('Recibo');
	}
}