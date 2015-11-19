<?php 
class MongoCliente extends EloquentMongo{
	protected $collection = "cliente";

	public function venta() {
		return $this->hasMany('Venta');
	}

	public function telefono() {
		return $this->hasOne('Telefono');
	}
}
?>