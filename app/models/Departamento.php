<?php

class Departamento extends Eloquent {
	protected $table = 'departamento';
	public $timestamps = false;

	public function usuario() {
		return $this->hasMany('Usuario');
	} 

	public function rubro() {
		return $this->hasMany('Rubro');
	}

	public function almacen() {
		return $this->hasMany('Almacen');
	}

	public function puesto() {
		return $this->hasMany('Puesto');
	}
}