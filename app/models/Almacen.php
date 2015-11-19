<?php

class Almacen extends Eloquent {
	protected $table = 'almacen';
	public $timestamps = false;

	public function departamento() {
		return $this->belongsTo('Departamento');
	}

	public function inventario() {
		return $this->hasMany('Inventario');
	}
}