<?php

class MaterialValor extends Eloquent {
	protected $table = 'material_valor';
	public $timestamps = false;

	public function valor() {
		return $this->belongsTo('Valor');
	}

	public function inventario() {
		return $this->belongsTo('Inventario');
	}
}