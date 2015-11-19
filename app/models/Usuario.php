<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends Eloquent implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait;

	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usuario';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('contrasenia', 'remember_token');

	public function persona() {
		return $this->belongsTo('Persona');
	}

	public function rol() {
		return $this->belongsTo('Rol');
	}

	public function departamento() {
		return $this->belongsTo('Departamento');
	}

	public function quejaseguimiento() {
		return $this->hasMany('QuejaSeguimiento');
	}

	public function queja() {
		return $this->hasMany('Queja');
	}

	public function movimiento() {
		return $this->hasMany('Movimiento');
	}

	public function getPasswordAttribute(){
		return $this->attributes['contrasenia'];
	}
}