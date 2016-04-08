<?php 
	class PanelAdministracion {
		public function get(){
			$graficos = array();
			$ventasTotales = VentasTotales::all();
			$graficos["ventasTotales"] = $ventasTotales;
			return $graficos;
		}
	}