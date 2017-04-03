<?php

class TotalesGrafica extends Eloquent {
	protected $table = 'totales_grafica';
	public $timestamps = false;
	protected $fillable = array('year','month','monto');
	
}