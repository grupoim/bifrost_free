<?php

class MaterialColor extends Eloquent {
	protected $table = 'material_color';
	public $timestamps = false;
	

	public function color() {
		return $this->hasMany('Color','id');
	}

	public function material() {
		return $this->hasMany('Material','id');
	}
	public function laminaalta() {
		return $this->belongsToMany('LaminaAlta','material_color_id');
	}
	
}