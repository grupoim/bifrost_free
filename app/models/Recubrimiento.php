<?php

class Recubrimiento extends Eloquent {
	protected $table = 'recubrimiento';
	public $timestamps = false;

	public function recubrimientomaterial() {
		return $this->hasMany('RecubrimientoMaterial');
	}

	public function producto() {
		return $this->belongsTo('Producto');
	}
}