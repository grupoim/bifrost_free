<?php

class AperturaOrden extends Eloquent {
	protected $table = 'apertura_orden';

	public function usuario() {
		return $this->belongsTo('Usuario');
	}

}