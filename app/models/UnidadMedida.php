<?php

class UnidadMedida extends Eloquent {
	protected $table = 'unidad_medida';
	public $timestamps = false;

	public function inventario() {
		return $this->hasMany('Inventario');
	}
}