<?php

class GraficaCapturaVendedor extends Eloquent {
	protected $table = 'grafica_captura_vendedor';
	public $timestamps = false;
	protected $fillable = array( 'tipo_mentenimiento_captura_id','grafica_vendedores_id');
}