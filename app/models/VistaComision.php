<?php

class VistaComision extends Eloquent {
	protected $table = 'vista_comision';
	public $timestamps = false;

	public function abonos() {
		return $this->hasMany('AbonoComision','comision_id');
	}

	public function vistaabonocomisionperiodo() {
		return $this->hasMany('VistaAbonoComisionPeriodo','comision_id');
	}


}