<?php

class AbonoComision extends Eloquent {
	protected $table = 'abono_comision';

	public function comision() {
		return $this->belongsTo('Comision');
	}
}