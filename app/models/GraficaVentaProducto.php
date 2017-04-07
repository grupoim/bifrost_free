<?php

class GraficaVentaProducto extends Eloquent {
	protected $table = 'grafica_venta_producto';
	public $timestamps = false;
	protected $fillable = array('totales_grafica_id','producto_grafica_id');
}