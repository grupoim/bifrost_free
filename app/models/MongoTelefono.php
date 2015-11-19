<?php 
class MongoTelefono extends EloquentMongo{
	protected $collection = "telefono";

	public function cliente() {
		return $this->belongsTo('MongoCliente');
	}
}
?>