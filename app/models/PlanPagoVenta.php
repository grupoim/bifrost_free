<?php

class PlanPagoVenta extends Eloquent {
	protected $table = 'plan_pago_venta';

	public function venta() {
		return $this->belongsTo('Venta');
	}

	public function planpago() {
		return $this->belongsTo('PlanPago');
	}
}