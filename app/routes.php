<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::group(array('before' => 'auth'), function(){
	Route::get('/', 'PanelControlador@index');
	Route::controller('/login', 'LoginControlador');
	Route::controller('/cotizacion', 'CotizacionControlador');
	Route::controller('/cobranza', 'CobranzaControlador');
	
	Route::get('comision/detalle/{id?}', 'ComisionControlador@detalle');	
	Route::controller('/comision', 'ComisionControlador');	
	Route::controller('/queja', 'QuejaControlador');
	Route::controller('/almacen', 'AlmacenControlador');
	Route::controller('/servicio-funeral', 'ServicioFuneralControlador');
	Route::controller('/recubrimiento', 'RecubrimientoControlador');
	Route::controller('/material',  'MaterialControlador');
	Route::controller('/mantenimiento',  'MantenimientoControlador');

	Route::controller('/contratacion',  'ContratacionControlador');
	Route::controller('/cesion-derecho',  'CesionDerechoControlador');
	Route::controller('/titulo-propiedad',  'TituloPropiedadControlador');
	Route::controller('/carta-beneficiario',  'CartaBeneficiarioControlador');
	Route::controller('/inhumacion',  'InhumacionControlador');
	Route::controller('/exhumacion',  'ExhumacionControlador');
	Route::controller('/lote-funerario',  'LoteFunerarioControlador');
	Route::controller('/personal-operativo',  'PersonalOperativoControlador');
	Route::controller('/configuracion-general',  'ConfiguracionControlador');
	Route::controller('/producto',  'ProductoControlador');
	Route::controller('/plan-pago',  'PlanPagoControlador');
	Route::controller('/nota-credito',  'NotaCreditoControlador');
	Route::controller('/asesor',  'AsesorControlador');
	Route::controller('/cliente',  'ClienteControlador');
	Route::controller('/persona', 'PersonaControlador');
	Route::controller('/venta', 'VentaControlador');
	Route::controller('/colonia', 'ColoniaControlador');
	Route::controller('/inventario-recub', 'InventarioRecubControlador');
	Route::controller('/construccion', 'ConstruccionControlador');
	Route::controller('/perfil-usuario', 'PerfilControlador');
	Route::controller('/extra', 'ExtraControlador');
});
Route::controller('/login', 'LoginControlador');

