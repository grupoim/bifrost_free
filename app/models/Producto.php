<?php

class Producto extends Eloquent {
	protected $table = 'producto';
	public $timestamps = false;

	public function departamento() {
		return $this->belongsTo('Departamento');
	}

	public function construccion() {
		return $this->hasMany('Construccion');
	}

	public function mantenimiento() {
		return $this->hasMany('Mantenimiento');
	}

	public function exhumacion() {
		return $this->hasMany('Exhumacion');
	}

	public function precio() {
		return $this->hasMany('Precio');
	}

	public function paquete() { 
		return $this->hasMany('Paquete');
	}

	public function recubrimiento() {
		return $this->hasMany('Recubrimiento');
	}

	public function extra() {
		return $this->hasMany('Extra');
	}

	public function lote() {
		return $this->hasMany('Lote');
	}

	public function serviciofuneral() {
		return $this->hasMany('ServicioFuneral');
	}

	public function tramite() {
		return $this->hasMany('Tramite');
	}

	public function inhumacion() {
		return $this->hasMany('Inhumacion');
	}

	public function ventaproducto() {
		return $this->hasMany('VentaProducto');
	}

	public function productos() {
		return $this->belongsToMany('Producto', 'paquete', 'paquete_id', 'producto_id');
	}
}