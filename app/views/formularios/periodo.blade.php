@section('scripts')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script>

  $(function() {
   
//Array para dar formato en español
 $.datepicker.regional['es'] = 
 {
 closeText: 'Cerrar', 
 prevText: 'Previo', 
 nextText: 'Próximo',
 
 monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
 'Jul','Ago','Sep','Oct','Nov','Dic'],
 monthStatus: 'Ver otro mes', yearStatus: 'Ver otro año',
 dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
 dateFormat: 'yy-mm-dd', firstDay: 0, 
 initStatus: 'Selecciona la fecha', isRTL: false};
$.datepicker.setDefaults($.datepicker.regional['es']);

//miDate: fecha de comienzo D=días | M=mes | Y=año
//maxDate: fecha tope D=días | M=mes | Y=año
   $( "#datepicker" ).datepicker({ minDate: "-7D", maxDate: "+7D" });

 });
  </script>
@stop
@section('module')
	{{-- ocultar mensajes de alerta automaticamente =======--}}
    {{ Form::close() }} 
<script type="text/javascript">
      window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
  });
}, 2000);
    </script>
    {{-- fin ocultar mensajes de alerta automaticamente ======= --}}
 <!-- Form starts.  -->
 
   {{ Form::open(array('action' => 'PersonalOperativoControlador@postCrealista', 'class' => 'form-horizontal', 'role' => 'form')) }} 
                    
     	<div class="form-group">
                        <label class="col-lg-3 control-label">Tipo Lista</label>
                        <div class="col-lg-9">
                                    <label class="radio-inline"><input type="radio" name="tipo_lista" value="6" id="r1corte" checked="true">Semana</label>
                          <label class="radio-inline"><input type="radio" name="tipo_lista" value="14" id="r2corte">Quincena</label>                          
                          
                                            
                        </div>
                      </div>		
  	                       
                          
    <div class="form-group">
                                  <label class="col-lg-3 control-label">Fecha de fin</label>
                                  <div class="col-lg-8">
                                   @if($errors->has('fecha')) 


                                   <div align="center" class="alert alert-danger alerta">{{$errors->first('fecha')}}</div> @endif
                                     <p> <input type="text" id="datepicker" name="fecha"></p>   
                                  </div>
                      </div>                              
                          
                                                               
    <div class="col-lg-2 control-label"> 
	    <button type="submit" class="btn btn-sm btn-primary">
		    
		    	Crear 
		   
		    
	    </button>                             
       <a href= "{{ action('PersonalOperativoControlador@getIndex') }}" class="btn btn-primary" >Regresar</a> 

     </div>       

@stop