<?php

class LaminaAlta extends Eloquent {
	protected $table = 'lamina_alta';
	public $timestamps = false;
	


	public function proveedor() {
		return $this->belongsTo('Proveedor');
	}
	
	public function vistamaterialcolor() {
		return $this->hasMany('VistaMaterialColor');
	}

	public function inventariorecubrimientos() {
			return $this->belongsTo('InventarioRecubrimientos','lamina_alta_id');
		}

	}	
