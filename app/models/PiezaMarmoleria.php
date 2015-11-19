<?php

class PiezaMarmoleria extends Eloquent {
	protected $table = 'pieza_marmoleria';
	public $timestamps = false;

	public function departamento() {
		return $this->belongsTo('MaterialBaja');
	}
}