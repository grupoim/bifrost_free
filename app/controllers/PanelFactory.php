<?php 
	class PanelFactory{
		public static function build($department){
			$panel = "Panel".$department;
			if(class_exists($panel)){
				return new $panel();
			}else{
				throw new Exception("El departamento no existe: ".$panel, 1);
			}
		}
	}
 ?>
