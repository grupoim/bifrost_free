<?php

class Queja extends Eloquent {
	protected $table = 'queja'; // <-- declaramos la tabla que usa el modelo.
	protected $fillable = array('rubro_id', 'usuario_id', 'descripcion','foto'); 

	public function quejaseguimiento() {
		return $this->hasMany('QuejaSeguimiento');
	}

	public function usuario() {
		return $this->belongsTo('Usuario');
	}

	public function rubro() {
		return $this->belongsTo('Rubro');
	}

	public function mantenimientoqueja() {
		return $this->hasMany('MantenimientoQueja');
	}

	public static function guardarDatos($input) { // <--función que recibe como parámetro la información del formulario para crear el registro.
		$respuesta = array(); // <-- creo una variable que recibira respuesta de error o afirmación
		$reglas = array( //<-- Declaramos reglas para validar datos
		// OJO LAS VARIABLES DECLARADAS DEBEN SER LAS MISMAS QUE LA VISTA
			'rubro_id' => 'required',
			'usuario_id' => 'required', 
			'descripcion' => array('required', 'max:255'),
		);

		$validator = Validator::make($input, $reglas); // <-- VALIDO LO CAPTURADO CON LAS REGLAS

		if ($validator->fails()) {
			// si no cumplen las reglas se van a devolver los errores al controlador
			$respuesta['mensaje'] = $validator;
			$respuesta['error'] = true;
		} else {
			$queja = static::create($input);
			// se retorna un mensaje de éxito al controlador
			$respuesta['mensaje'] = "Queja Creada";
			$respuesta['error'] = false;
			$respuesta['data'] = $queja;
		}

		return $respuesta;
	}
}