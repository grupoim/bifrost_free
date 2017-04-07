<?php

class ProductoGrafica extends Eloquent {
	protected $table = 'producto_grafica';
	public $timestamps = false;
	protected $fillable = array( 'nombre','activo','departamento_id','extra','cartera','mantenimiento','categoria');
}
