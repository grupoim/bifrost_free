<?php

class Extra extends Eloquent {
	protected $table = 'extra';
	public $timestamps = false;

	public function producto() {
		return $this->belongsTo('Producto');
	}
}