<?php 
class MongoVenta extends EloquentMongo{
	protected $collection = "venta";

	public function ventaproducto() {
		return $this->hasMany('VentaProducto');
	}

	public function seguimientoventa() {
		return $this->hasMany('SeguimientoVenta');
	}

	public function cliente() {
		return $this->belongsTo('Cliente');
	}
}
 ?>
