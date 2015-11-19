<?php

class PersonaControlador extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id = 0)
	{
		
	}

	public function getAll(){
		return DB::table('persona')->select('id', DB::raw("CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as nombre"))->get();
	}

	public function getTitulares(){
		$inhumados = DB::table('inhumado')->join('persona', 'persona.id', '=', 'inhumado.persona_id')->select('persona.id', DB::raw("CONCAT(persona.nombres, ' ', persona.apellido_paterno, ' ', persona.apellido_materno) as nombre"));
		return DB::table('titular')->join('persona', 'persona.id', '=', 'titular.persona_id')->select('persona.id', DB::raw("CONCAT(persona.nombres, ' ', persona.apellido_paterno, ' ', persona.apellido_materno) as nombre"))->union($inhumados)->get();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
