<?php

class Nicho extends Eloquent {
	protected $table = 'nicho';
	public $timestamps = false;

	public function lote() {
		return $this->belongsTo('Lote');
	}

	public function recinto() {
		return $this->belongsTo('Recinto');
	}
}