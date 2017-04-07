<?php

class TipoPropiedadPeriodoMantenimiento extends Eloquent {
	protected $table = 'tipo_propiedad_periodo_mantenimiento';
	public $timestamps = false;
	protected $fillable = array('periodo_mantenimiento_id','producto_grafica_id','totales_grafica_id');
}