<?php

class PlanPago extends Eloquent {
	protected $table = 'plan_pago';
	

	public function planpagoventa() {
		return $this->hasMany('PlanPagoVenta');
	}
}