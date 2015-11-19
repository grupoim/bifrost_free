<?php 
	class PanelFactory{
		public static function build($department){
			$panel = camel_case("Panel".$department);
			if(class_exists($panel)){
				return new $panel();
			}else{
				throw new Exception("El departamento no existe.", 1);
			}
		}
	}
 ?>
