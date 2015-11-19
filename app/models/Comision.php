<?php

class Comision extends Eloquent {
	protected $table = 'comision';

	public function getTotalAttribute($total){
		return number_format($total, 2, ".", ",");
	}

	public function abonocomision() {
		return $this->hasMany('AbonoComision');
	}

	public function asesor() {
		return $this->belongsTo('Asesor');
	}

	public function venta() {
		return $this->belongsTo('Venta');
	}
}