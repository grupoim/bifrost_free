<?php

class Funeraria extends Eloquent {
	protected $table = 'funeraria';
	public $timestamps = false;

	public function funerariaventainhumacion() {
		return $this->hasMany('FunerariaVentaInhumacion', 'foreign_key', 'capilla_id');
	}
}