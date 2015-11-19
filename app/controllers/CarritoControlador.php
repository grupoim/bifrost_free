<?php 
	class CarritoControlador extends ModuloControlador{
		
		public function getIndex(){
			
		}

		public function getContenido($id){	

			$producto = producto::find($id);
			$precio = precio::where('producto_id', '=', $id)->first();
			$cantidad = 3;						

		
		return Response::json(
									
							$contenido =array(
								"cantidad"=>  $cantidad,
								"descripcion" =>  $producto->nombre,
								"precio_unitario" => $precio->monto,
								"subtotal" => $precio->monto * $cantidad
								));
	}
	}