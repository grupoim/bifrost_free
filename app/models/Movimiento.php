<?php

class Movimiento extends Eloquent {
	protected $table = 'movimiento';

	public function usuario() {
		return $this->belongsTo('Usuario');
	}

	public function accion() {
		return $this->belongsTo('Accion');
	}

	public function inventario() {
		return $this->belongsTo('Inventario');
	}
}