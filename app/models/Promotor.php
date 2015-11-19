<?php

class Promotor extends Eloquent {
	protected $table = 'promotor';
	public $timestamps = false;

	public function asesor() {
		return $this->belongsTo('Asesor', 'foreign_keys', 'promotor_id');
	}
}