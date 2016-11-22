<?php

class VistaAbonoComisionPeriodo extends Eloquent {
	protected $table = 'vista_abono_comision_periodo';

	
	public function vistacomision() {
		return $this->belongsTo('VistaComision');
	}


}