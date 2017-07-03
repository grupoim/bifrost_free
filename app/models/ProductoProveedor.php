<?php

class ProductoProveedor extends Eloquent {
	protected $table = 'producto_proveedor';
	public $timestamps = false;
	protected $fillable = array('proveedor_id','producto_id');
}