<?php

class Asistencia extends Eloquent {
	protected $table = 'asistencia';
	public $timestamps = false;

	public function lista() {
		return $this->belongsTo('Lista');
	}

	
}