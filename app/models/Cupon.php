<?php

class Cupon extends Eloquent {
	protected $table = 'cupon';
	public $timestamps = false;

	public function cuponventa() {
		return $this->hasMany('CuponVenta');
	}

	public function cliente() {
		return $this->belongsTo('Cliente');
	}
}