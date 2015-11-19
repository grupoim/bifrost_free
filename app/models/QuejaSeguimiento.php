<?php

class QuejaSeguimiento extends Eloquent {
	protected $table = 'queja_seguimiento';

	public function queja() {
		return $this->belongsTo('Queja');
	}

	public function usuario() {
		return $this->belongsTo('Usuario');
	}
}