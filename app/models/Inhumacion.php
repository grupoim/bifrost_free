<?php

class Inhumacion extends Eloquent {
	protected $table = 'inhumacion';
	public $timestamps = false;

	public function producto() {
		return $this->belongsTo('Producto');
	}
}