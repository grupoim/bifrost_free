<?php

class Precio extends Eloquent {
	protected $table = 'precio';

	public function producto() {
		return $this->belongsTo('Producto');
	}
}