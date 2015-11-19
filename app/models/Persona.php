<?php

class Persona extends Eloquent {
	protected $table = 'persona';
	public $timestamps = false;
	protected $fillable = array('nombres', 'apellido_paterno', 'apellido_materno', 'fecha_nacimiento', 'sexo');  

	public function usuario() {
		return $this->hasOne('Usuario');
	}

	public function titular() {
		return $this->hasMany('Titular');
	}

	public function beneficiario() {
		return $this->hasMany('Beneficiario');
	}

	public function empleado() {
		return $this->hasOne('Empleado', 'empleado_id');
	}

	public function inhumado() {
		return $this->hasMany('Inhumado');
	}

	public function asesor() {
		return $this->hasOne('Asesor');
	}

	public function cliente() {
		return $this->hasOne('Cliente');
	}

	public static function guardarDatos($input) { // <--función que recibe como parámetro la información del formulario para crear el registro.
		$respuesta = array(); // <-- creo una variable que recibira respuesta de error o afirmación
		$reglas = array( //<-- Declaramos reglas para validar datos
		// OJO LAS VARIABLES DECLARADAS DEBEN SER LAS MISMAS QUE LA VISTA    //			
			'nombres' => array('required', 'max:45'),
			'apellido_paterno' => array('required', 'max:45'), 
			'apellido_materno' => 'max:255',
			'fecha_nacimiento' => 'required',
			'sexo' => 'required',
		);

		$validator = Validator::make($input, $reglas); // <-- VALIDO LO CAPTURADO CON LAS REGLAS

		if ($validator->fails()) {
			// si no cumplen las reglas se van a devolver los errores al controlador
			$respuesta['mensaje'] = $validator;
			$respuesta['error'] = true;
		} else {
			$persona = static::create($input);

//			$asesor = $persona->asesor()->save($input);

			// se retorna un mensaje de éxito al controlador
			$respuesta['mensaje'] = "Registro Creado";
			$respuesta['error'] = false;
			$respuesta['data'] = $persona;
		}

		return $respuesta;
	}

	public static function guardarEmpleado($input) { // <--función que recibe como parámetro la información del formulario para crear el registro.
			$persona = static::create($input);

//			
		}

		
	}	
