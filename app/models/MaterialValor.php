<?php

class MaterialValor extends Eloquent {
	protected $table = 'material_valor';
	public $timestamps = false;

	public function valor() {
		return $this->belongsTo('Valor');
	}

	public function inventariorecub() {
		return $this->belongsTo('InventarioRecub', 'material_valor_id');
	}
}