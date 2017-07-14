<?php

class Rescatista extends Eloquent {
	protected $table = 'rescatista';
	public $timestamps = false;


		public function persona() {
		return $this->belongsTo('Persona');
	}

}