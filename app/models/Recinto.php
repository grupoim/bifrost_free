<?php

class Recinto extends Eloquent {
	protected $table = 'recinto';
	public $timestamps = false;

	public function sector() {
		return $this->belongsTo('Sector');
	}

	public function nicho() {
		return $this->hasMany('Nicho');
	}
}