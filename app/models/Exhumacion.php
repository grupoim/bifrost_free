<?php

class Exhumacion extends Eloquent {
	protected $table = 'exhumacion';
	public $timestamps = false;

	public function producto() {
		return $this->belongsTo('Producto');
	}
}