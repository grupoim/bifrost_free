<?php

class TestigoDeInhumado extends Eloquent {
	protected $table = 'testigo_de_inhumado';
	public $timestamps = false;

	public function contactotestigorescate() {
		return $this->hasMany('ContactoTestigoRescate');
	}

		public function inhumado() {
		return $this->belongsTo('Inhumado');
	}

		public function persona() {
		return $this->belongsTo('Persona');
	}
			public function parentezco() {
		return $this->belongsTo('Parentezco');
	}
}