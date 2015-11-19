<?php

class Empleado extends Eloquent {
	protected $table = 'empleado';
	protected $fillable = array('persona_id', 'fecha_ingreso');
	public $timestamps = false;

	public function persona() {
		return $this->belongsTo('Persona');
	}

	public function ventamantenimiento() {
		return $this->hasMany('VentaMantenimiento');
	}
}