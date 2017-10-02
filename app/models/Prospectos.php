<?php

class Prospectos extends Eloquent {
	protected $table = 'prospectos';
	public $timestamps = false;
	protected $fillable = array('dato_solicitante_id','solicitud_id','activo');
}