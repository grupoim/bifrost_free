<?php

class TipoTelefono extends Eloquent {
	protected $table = 'tipo_telefono';
	public $timestamps = false;

	public function telefono() {
		return $this->hasMany('Telefono');
	}
}