<?php

class Empresa extends Eloquent {
	protected $table = 'empresa';
	protected $fillable = array('id', 'nombre','razon_social', 'rfc', 'domicilio');
	public $timestamps = false;

	public function Municipio() {
		return $this->belongsTo('Municipio');
	}
	
}