<?php

class MaterialBaja extends Eloquent {
	protected $table = 'material_baja';
	

	public function inventariorecubrimientos() {
		return $this->belongsTo('InventarioRecubrimientos');
	}

	public function piezamarmoleria() {
		return $this->hasMany('PiezaMarmoleria');
	}

	public function ventamaterial() {
		return $this->belongsTo('VentaMaterial');
	}	

}