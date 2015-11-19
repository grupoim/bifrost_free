<?php

class Paquete extends Eloquent {
	protected $table = 'paquete';
	public $timestamps = false;
	
	
	public function producto() {
		return $this->belongsTo('Producto', 'paquete_id');
	}

	

}