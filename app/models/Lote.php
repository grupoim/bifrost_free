<?php

class Lote extends Eloquent {
	protected $table = 'lote';
	public $timestamps = false;

	public function producto() {
		return $this->belongsTo('Producto');
	}

	public function nicho() {
		return $this->hasMany('Nicho');
	}

	public function ventamantenimiento() {
		return $this->hasMany('VentaMantenimiento');
	}

	public function terreno() {
		return $this->hasMany('Terreno');
	}

	public function ventainhumacion() {
		return $this->hasMany('VentaInhumacion');
	}
}