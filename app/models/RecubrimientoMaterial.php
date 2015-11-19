<?php

class RecubrimientoMaterial extends Eloquent {
	protected $table = 'recubrimiento_material';
	public $timestamps = false;

	public function recubrimiento() {
		return $this->belongsTo('Recubrimiento');
	}

	public function material() {
		return $this->belongsTo('Material');
	}
}