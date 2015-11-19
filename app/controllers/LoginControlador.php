<?php 
	class LoginControlador extends BaseController{
		public function getIndex(){
 			return View::make("formularios.login");
		}

		public function postAutenticar(){
			if (Auth::attempt(array('nombre' => Input::get('usuario'), 'password' => Input::get('contrasenia')))){
    				return Redirect::intended('/');
			}else{
				return Redirect::intended('/login');
			}
		}

		public function getSalir(){
			Auth::logout();
			return Redirect::to('login');
		}
	}
 ?>