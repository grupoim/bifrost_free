<?php 
	class PanelTramites {
		public function get(){
			$graficos = array();
			$ventasTotales = VentasTotales::all();
			$graficos["ventasTotales"] = $ventasTotales;
			return $graficos;
		}
	}