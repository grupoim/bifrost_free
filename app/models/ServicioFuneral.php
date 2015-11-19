<?php

class ServicioFuneral extends Eloquent {
	protected $table = 'servicio_funeral';
	public $timestamps = false;

	public function producto() {
		return $this->belongsTo('Producto');
	}
}