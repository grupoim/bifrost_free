<?php

class Paquete extends Eloquent {
	protected $table = 'paquete';
	public $timestamps = false;

	public function producto() {
		return $this->belongsTo('Producto');
	}

	public function paquete() { /* TENGO DUDAS AQUI COMO INTERPRELTARLO */
		return $this->belongsTo('Paquete', 'paquete', 'id')
	}
}