<?php

class InventarioRecubrimientos extends Eloquent {
	protected $table = 'inventario_recubrimientos';
	

	public function laminaalta() {
		return $this->belongsTo('LaminaAlta','id');
	}

	public function materialbaja() {
		return $this->hasOne('materialbaja');
	}
	
}