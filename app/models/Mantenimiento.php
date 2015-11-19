<?php

class Mantenimiento extends Eloquent {
	protected $table = 'mantenimiento';
	public $timestamps = false;

	public function producto() {
		return $this->belongsTo('Producto');
	}

	public function construccion() {
		return $this->belongsTo('Construccion');
	}

	public function sector() {
		return $this->belongsTo('Sector');
	}
}