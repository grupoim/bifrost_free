<?php

class VistaMaterialColor extends Eloquent {
	protected $table = 'vista_material_color';
	public $timestamps = false;

	public function laminaalta() {
		return $this->belongsTo('LaminaAlta');
	}
}