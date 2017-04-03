<?php

class GraficaVendedores extends Eloquent {
	protected $table = 'grafica_vendedores';
	public $timestamps = false;
	protected $fillable = array( 'asesor_id','totales_grafica_id');
}